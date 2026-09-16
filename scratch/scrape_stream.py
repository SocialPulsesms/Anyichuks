import urllib.request
import re

url = 'https://ifeanyiodii.com/philanthropy/'
req = urllib.request.Request(
    url, 
    headers={'User-Agent': 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'}
)

try:
    with urllib.request.urlopen(req) as response:
        html = response.read().decode('utf-8')
except Exception as e:
    print(f"Error fetching url: {e}")
    with urllib.request.urlopen(url) as response:
        html = response.read().decode('utf-8')

# Let's extract all image tags and all paragraph/header contents from the html
from html.parser import HTMLParser

class FullParser(HTMLParser):
    def __init__(self):
        super().__init__()
        self.tags = []
        self.current_tag = ""
        self.content_list = []
        self.images = []

    def handle_starttag(self, tag, attrs):
        self.current_tag = tag
        attrs_dict = dict(attrs)
        if tag == 'img' and 'src' in attrs_dict:
            src = attrs_dict['src']
            if not any(x in src for x in ['emoji', 'tracker', 'logo', 'icon', 'svg']):
                self.images.append(src)
                self.content_list.append(f"__IMG_MARKER__:{src}")

    def handle_endtag(self, tag):
        self.current_tag = ""

    def handle_data(self, data):
        if self.current_tag in ['p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div', 'span', 'li']:
            text = data.strip()
            if text and len(text) > 10:
                # Filter out scripts / dynamic contents
                if not any(x in text for x in ['{', '}', 'function', 'var ', 'jQuery', 'window.', 'document.']):
                    self.content_list.append(f"{self.current_tag}:{text}")

parser = FullParser()
parser.feed(html)

print("=== RAW STREAM ===")
for item in parser.content_list:
    print(item)
