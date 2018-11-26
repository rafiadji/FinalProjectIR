import scrapy

class BlogSpider(scrapy.Spider):
    name = 'Tribunnews'
    start_urls = ['http://www.tribunnews.com/tag/malang']

    def parse(self, response):
        for title in response.css('div.mr140>h3'):
            yield {'title': title.css('a::text').extract_first()}

        # for next_page in response.css('div.prev-post > a'):
        #     yield response.follow(next_page, self.parse)