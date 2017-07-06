title: Deferring Work
summary: How to avoid doing it all in the request
introduction: Users shouldn't have to wait for a background process to finish before their page reloads

One of the most effective techniques for improving user experience and overall performance on a site is embracing the
concept of deferring work; using a request to trigger a background process, rather than executing the process in the 
request itself.
 
## Queued Jobs
 
Making use of the [Queued Jobs Module](https://github.com/silverstripe-australia/silverstripe-queuedjobs) is an easy
way to get the best out of your site, and it comes bundled in to the CWP Basic Recipe. On request, you should create
a job that performs the task in the background, to be processed when it reaches the front of the queue. In this way, 
you give instant feedback to the user, and the task is able to be executed in the background - which has less overhead 
than the web version of the same request. Additionally, you should batch any requests that deal with large datasets, or 
tasks that take a long time to process.

For example, if you have a sign-up form that requires a large amount of processing before sending out a confirmation 
email, it would likely be a slow process to execute all that in the request - and would provide a poor user experience 
for the person signing up. Far better would be to add a `ProcessSignUpJob` to the Job Queue, immediately return 
confirmation to the user once the job has been added, and let the queue run the job when it can, in the background. It 
may mean a small delay on the sending of the email while the job makes its way to the top of the queue, but it provides 
a much better experience for the user - and reduces the impact on the server.

<div class="notice">
    This also helps to mitigate the impact of Denial of Service (DOS) attacks, as it is much harder to induce load when 
    you remove the processing from the request. The queue ensures sensible distribution of the server resources.
</div>

You can see this in action with the Solr Reindex Task - where previously this would execute inside the request and 
potentially throw an error after timing out, now it adds a `SolrReindexJob` to the queue and returns a standard task
page.

## Cron Jobs

A cron job is task that executes on a schedule. For example, on CWP the task that executes the jobs in the job queue is 
called every minute. One of the most common implementations of a cron job is to schedule something to run outside of 
normal business hours, when traffic levels to your site are at their lowest. This means that any intensive work will be 
executed at a time that will impact the least number of users. There are 
[a lot of ways to tweak the frequency](http://www.thegeekstuff.com/2009/06/15-practical-crontab-examples) to achieve 
what you need. This is especially useful if you need to export or import a large amount of data on a schedule.

On CWP these will need to be added via a Service Desk request; alternatively you can utilise the 
[Crontask module](https://github.com/silverstripe/silverstripe-crontask) to retain complete developer control over the 
jobs. This will then require that a cron job be set up to run the cron tasks, but that means it is a one-off rather than
per-task request.

## XMLHTTPRequest (XHR)

[XHR](https://en.wikipedia.org/wiki/XMLHttpRequest) is most commonly used through AJAX, or
[Aysnchronous Javascript And XML](http://www.seguetech.com/ajax-technology/), a method of reacting to user input, making
a request to the server, and returning an updated page, without having to reload the entire page contents. It provides a
much better user-experience when only a small section of a page needs to reload, and is inevitably faster too. This is 
because the web server has far fewer elements and data to process, resulting in faster load times, and the impression 
that the user has "stayed on the page". This is another example of "perceived performance". Reducing the amount of 
processing required on each click is a simple way to reduce server load and establish overall better response times and 
sustain higher amounts of simultaneous users.

## Next

Continue to our performance guide on [Frontend Best Practices](frontend-best-practices).
