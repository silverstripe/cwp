title: Frontend Best Practices
summary: Lose weight in the browser with this one weird trick!
introduction: The goal with front-end performance work is to reduce the amount of HTML that the browser has to render.
 
In saying that, another useful thing to consider is "perceived performance". Users are far more likely to stay and wait 
for the page to load if the most of the page has already loaded, so getting as much in as quickly as possible is 
crucial for user experience. 

[Browser Diet](https://browserdiet.com/) is a fantastic resource for front-end optimisation strategies - and below we
will focus on a few that will have the most use on the CWP environments.

## Incapsula

Firstly though, it is important to know what is already being done. One of the benefits of Incapsula is that it provides
content optimisation, which CWP sites will use by default. This includes:

- JavaScript minification
- CSS minification
- Static HTML minification
- JPEG compression
- PNG compression
- "On the fly" compression of JavaScript, HTML and CSS files (gzip)

This covers a lot of the ground explored in the article above, but there is yet more work to do!

## Combining Files

Best practice for organisation and maintenance of styles is to separate your concerns - a file per component. However, 
this is not as good for HTTP requests, as the browser will limit the number of simultaneous resources downloaded in 
parallel. Combining them means less requests, and a faster load time.

SilverStripe comes with a built-in method of combining your CSS and JavaScript files. Have a look at
[the documentation](https://docs.silverstripe.org/en/3/developer_guides/templates/requirements/#combining-files) to see 
how easy it is - and remember, if your site is in `dev` mode, combined files will be disabled!

[read more...](https://browserdiet.com/#combine-css)

## Asynchronous Loading

To understand the value of asynchronous loading, we need to understand how the HTML page is rendered - from top to
bottom. With a standard load, you need to wait for any given element to load before the ones below it do. However, if we
load something large (say, a script) asynchronously, we can let the HTML around it load, and then execute once the
entire script has loaded. This is particularly advantageous in two situations:

#### Large Scripts

If you need to load a large script in the middle of a page (i.e. you aren't able to force it to the bottom for loading),
you are likely better of loading it asynchronously, to allow the HTML around it to load first. This is as simple as the
following change:

```html
<!-- From this -->
<script src="One-Thousand-Magical-Herbs-and-Fungi-animations.js"></script>

<!-- To this -->
<script async src="One-Thousand-Magical-Herbs-and-Fungi-animations.js"></script>
```

[read more...](https://browserdiet.com/#async)

#### Third-party Content

Bringing in third-party content, such as a video or widget, implicitly relies on the third-party to respond quickly and
successfully so that your page load is completed in an acceptable time. To alleviate some of this pressure, you should
bring this content in asynchronously. By example:

```javascript
var script = document.createElement('script'),
    scripts = document.getElementsByTagName('script')[0];
script.async = true;
script.src = url;
scripts.parentNode.insertBefore(script, scripts);
```

[read more...](https://browserdiet.com/#3rd-party-async)

For more information on optimising your third-party integrations, see [our guide](../third-party-link).

