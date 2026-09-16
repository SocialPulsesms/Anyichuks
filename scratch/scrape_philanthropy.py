import urllib.request
import re
from html.parser import HTMLParser

class MyHTMLParser(HTMLParser):
    def __init__(self):
        super().__init__()
        self.in_body = False
        self.in_script_or_style = False
        self.text_content = []
        self.images = []

    def handle_starttag(self, tag, attrs):
        if tag in ['script', 'style']:
            self.in_script_or_style = True
        if tag == 'body':
            self.in_body = True
        
        attrs_dict = dict(attrs)
        if tag == 'img' and 'src' in attrs_dict:
            src = attrs_dict['src']
            # Avoid tracker pixels or tiny icons
            if not any(x in src for x in ['emoji', 'tracker', 'logo', 'icon', 'svg']):
                self.images.append(src)

    def handle_endtag(self, tag):
        if tag in ['script', 'style']:
            self.in_script_or_style = False
        if tag == 'body':
            self.in_body = False

    def handle_data(self, data):
        if self.in_body and not self.in_script_or_style:
            text = data.strip()
            if text:
                self.text_content.append(text)

# Fetch the page
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
    # Try a simple fetch without headers if it fails
    with urllib.request.urlopen(url) as response:
        html = response.read().decode('utf-8')

parser = MyHTMLParser()
parser.feed(html)

print("=== TEXT CONTENT ===")
for text in parser.text_content:
    # Print lines that look like sentences/paragraphs
    if len(text) > 30:
        print(text)

print("\n=== IMAGES ===")
for img in set(parser.images):
    print(img)
