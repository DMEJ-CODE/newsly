<?php

class AdminSyncController extends Controller {
    private $articleModel;

    public function __construct() {
        $this->articleModel = new Article();
    }

    public function sync() {
        $this->requireAdmin();

        $feeds = [
            // TECHNOLOGY
            ['url' => 'https://techcrunch.com/feed/', 'category_id' => 1, 'source' => 'TechCrunch'],
            ['url' => 'https://www.theverge.com/rss/index.xml', 'category_id' => 1, 'source' => 'The Verge'],
            ['url' => 'https://arstechnica.com/feed/', 'category_id' => 1, 'source' => 'Ars Technica'],
            ['url' => 'https://www.wired.com/feed/rss', 'category_id' => 1, 'source' => 'Wired'],
            ['url' => 'https://www.engadget.com/rss.xml', 'category_id' => 1, 'source' => 'Engadget'],
            ['url' => 'https://mashable.com/feed/', 'category_id' => 1, 'source' => 'Mashable'],
            
            // WORLD NEWS
            ['url' => 'http://feeds.bbci.co.uk/news/world/rss.xml', 'category_id' => 2, 'source' => 'BBC World'],
            ['url' => 'https://www.aljazeera.com/xml/rss/all.xml', 'category_id' => 2, 'source' => 'Al Jazeera'],
            ['url' => 'https://www.theguardian.com/world/rss', 'category_id' => 2, 'source' => 'The Guardian'],
            ['url' => 'http://rss.cnn.com/rss/edition_world.rss', 'category_id' => 2, 'source' => 'CNN World'],
            ['url' => 'https://www.nytimes.com/svc/collections/v1/publish/https://www.nytimes.com/section/world/rss.xml', 'category_id' => 2, 'source' => 'NYTimes'],
            
            // BUSINESS
            ['url' => 'https://finance.yahoo.com/news/rssindex', 'category_id' => 3, 'source' => 'Yahoo Finance'],
            ['url' => 'https://www.forbes.com/business/feed/', 'category_id' => 3, 'source' => 'Forbes'],
            ['url' => 'https://www.economist.com/business/rss.xml', 'category_id' => 3, 'source' => 'Economist'],
            ['url' => 'https://www.marketwatch.com/rss/topstories', 'category_id' => 3, 'source' => 'MarketWatch'],
            ['url' => 'https://www.businessinsider.com/rss', 'category_id' => 3, 'source' => 'Business Insider'],
            
            // SCIENCE
            ['url' => 'https://www.nasa.gov/rss/dyn/breaking_news.rss', 'category_id' => 4, 'source' => 'NASA'],
            ['url' => 'http://feeds.bbci.co.uk/news/science_and_environment/rss.xml', 'category_id' => 4, 'source' => 'BBC Science'],
            ['url' => 'https://www.sciencedaily.com/rss/all.xml', 'category_id' => 4, 'source' => 'Science Daily'],
            ['url' => 'https://www.space.com/feeds/all', 'category_id' => 4, 'source' => 'Space.com'],
            ['url' => 'https://www.nature.com/news.rss', 'category_id' => 4, 'source' => 'Nature'],
            
            // ENTERTAINMENT
            ['url' => 'http://feeds.bbci.co.uk/news/entertainment_and_arts/rss.xml', 'category_id' => 5, 'source' => 'BBC Ent.'],
            ['url' => 'https://variety.com/feed/', 'category_id' => 5, 'source' => 'Variety'],
            ['url' => 'https://www.rollingstone.com/feed/', 'category_id' => 5, 'source' => 'Rolling Stone'],
            ['url' => 'https://www.hollywoodreporter.com/feed/', 'category_id' => 5, 'source' => 'Holywood Reporter'],
        ];

        $syncCount = 0;
        $errorLogs = [];

        foreach ($feeds as $feed) {
            try {
                $rss = @simplexml_load_file($feed['url']);
                if (!$rss) {
                    $errorLogs[] = "Could not load feed: " . $feed['source'];
                    continue;
                }

                foreach ($rss->channel->item as $item) {
                    $title = (string)$item->title;
                    $link = (string)$item->link;
                    $description = (string)$item->description;
                    $pubDateString = (string)$item->pubDate;
                    $pubDate = !empty($pubDateString) ? date('Y-m-d H:i:s', strtotime($pubDateString)) : date('Y-m-d H:i:s');
                    
                    // Attempt to find an image in typical feed locations
                    $imageUrl = '';
                    
                    // 1. Media:content (most standard)
                    $media_namespaces = $rss->getNamespaces(true);
                    if (isset($media_namespaces['media'])) {
                        $media = $item->children($media_namespaces['media']);
                        if ($media->content) {
                            $imageUrl = (string)$media->content->attributes()->url;
                        } elseif ($media->thumbnail) {
                            $imageUrl = (string)$media->thumbnail->attributes()->url;
                        }
                    }
                    
                    // 2. Enclosure
                    if (empty($imageUrl) && $item->enclosure) {
                        $imageUrl = (string)$item->enclosure->attributes()->url;
                    }

                    // 3. Search in description (some feeds hide img tags in CDATA description)
                    if (empty($imageUrl)) {
                        preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $description, $matches);
                        if (isset($matches['src'])) {
                            $imageUrl = $matches['src'];
                        }
                    }

                    // Clean content: remove HTML tags from summary
                    $contentBody = strip_tags($description);
                    if (strlen($contentBody) < 150) {
                        $contentBody .= " ... [Visit " . $feed['source'] . " for the complete in-depth coverage of this story.]";
                    }

                    // Check if exists
                    if (!$this->articleModel->existsBySourceUrl($link)) {
                        if ($this->articleModel->create(
                            $title, 
                            $contentBody, 
                            $feed['category_id'], 
                            $imageUrl, 
                            $feed['source'], 
                            $link, 
                            $pubDate
                        )) {
                            $syncCount++;
                        }
                    }
                    
                    if ($syncCount >= 200) break 2; // Increased limit to 200 per burst
                }
            } catch (Exception $e) {
                $errorLogs[] = "Error syncing " . $feed['source'] . ": " . $e->getMessage();
            }
        }

        $_SESSION['admin_success'] = "Synchronized $syncCount new articles from live feeds.";
        if (!empty($errorLogs)) {
            $_SESSION['admin_error'] = implode("<br>", $errorLogs);
        }
        
        $this->redirect('admin/articles');
    }
}
