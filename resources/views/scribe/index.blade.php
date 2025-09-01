<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Shuwier API Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "http://backend.shuwier.com";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.3.0.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.3.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-endpoints" class="tocify-header">
                <li class="tocify-item level-1" data-unique="endpoints">
                    <a href="#endpoints">Endpoints</a>
                </li>
                                    <ul id="tocify-subheader-endpoints" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="endpoints-POSTapi-auth-register">
                                <a href="#endpoints-POSTapi-auth-register">User Registration.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-auth-resend-code">
                                <a href="#endpoints-POSTapi-auth-resend-code">Resend Verification Code.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-auth-verify-email">
                                <a href="#endpoints-POSTapi-auth-verify-email">Verify Email and Complete Registration.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-auth-reset-email">
                                <a href="#endpoints-POSTapi-auth-reset-email">Reset Email Address.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-auth-login">
                                <a href="#endpoints-POSTapi-auth-login">Client Login.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-auth-forget-password">
                                <a href="#endpoints-POSTapi-auth-forget-password">Forget Password - Send Reset Code.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-auth-reset-password">
                                <a href="#endpoints-POSTapi-auth-reset-password">Reset Password.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-auth-logout">
                                <a href="#endpoints-POSTapi-auth-logout">User Logout.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-auth-refresh">
                                <a href="#endpoints-POSTapi-auth-refresh">Refresh Token.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-admin-auth-login">
                                <a href="#endpoints-POSTapi-admin-auth-login">Admin Login.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-admin-freelancers">
                                <a href="#endpoints-GETapi-admin-freelancers">Display a listing of freelancers with optional filters.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-admin-freelancers-approve-reject--id-">
                                <a href="#endpoints-POSTapi-admin-freelancers-approve-reject--id-">Approve or Reject a freelancer application.</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: September 1, 2025</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<aside>
    <strong>Base URL</strong>: <code>http://backend.shuwier.com</code>
</aside>
<pre><code>This documentation aims to provide all the information you need to work with our API.

&lt;aside&gt;As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).&lt;/aside&gt;

## Language Support

All API endpoints support Arabic and English languages. Include the `Accept-Language` header in your requests:

- For Arabic: `Accept-Language: ar`
- For English: `Accept-Language: en`  

Example usage:
```bash
curl -X POST "http://backend.shuwier.com/api/auth/login" \
     -H "Content-Type: application/json" \
     -H "Accept: application/json" \
     -H "Accept-Language: ar" \
     -d '{"email":"user@example.com","password":"password123"}'
```</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>This API is not authenticated.</p>

        <h1 id="endpoints">Endpoints</h1>

    

                                <h2 id="endpoints-POSTapi-auth-register">User Registration.</h2>

<p>
</p>



<span id="example-requests-POSTapi-auth-register">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://backend.shuwier.com/api/auth/register" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en" \
    --data "{
    \"name\": \"John Doe\",
    \"email\": \"user@example.com\",
    \"password\": \"Password123!\",
    \"type\": \"freelancer\",
    \"linkedin_link\": \"https:\\/\\/linkedin.com\\/in\\/johndoe\",
    \"twitter_link\": \"https:\\/\\/twitter.com\\/johndoe\",
    \"other_freelance_platform_links\": [
        \"http:\\/\\/kunze.biz\\/iste-laborum-eius-est-dolor.html\"
    ],
    \"portfolio_link\": \"https:\\/\\/johndoe.com\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/auth/register"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

let body = {
    "name": "John Doe",
    "email": "user@example.com",
    "password": "Password123!",
    "type": "freelancer",
    "linkedin_link": "https:\/\/linkedin.com\/in\/johndoe",
    "twitter_link": "https:\/\/twitter.com\/johndoe",
    "other_freelance_platform_links": [
        "http:\/\/kunze.biz\/iste-laborum-eius-est-dolor.html"
    ],
    "portfolio_link": "https:\/\/johndoe.com"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-auth-register">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
  &quot;status&quot;: true,
  &quot;error_num&quot;: null,
  &quot;message&quot;: &quot;Verification code sent successfully&quot;,
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;Email already exists&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The email field is required.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-auth-register" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-auth-register"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-auth-register"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-auth-register" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-auth-register">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-auth-register" data-method="POST"
      data-path="api/auth/register"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-auth-register', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-auth-register"
                    onclick="tryItOut('POSTapi-auth-register');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-auth-register"
                    onclick="cancelTryOut('POSTapi-auth-register');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-auth-register"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/auth/register</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-auth-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-auth-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="POSTapi-auth-register"
               value="en"
               data-component="header">
    <br>
<p>Example: <code>en</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-auth-register"
               value="John Doe"
               data-component="body">
    <br>
<p>User full name. Must match the regex /^(?:[ء-ي]+(?:\s[ء-ي]+)<em>)$|^(?:[a-zA-Z]+(?:\s[a-zA-Z]+)</em>)$/u. Must not be greater than 255 characters. Example: <code>John Doe</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-auth-register"
               value="user@example.com"
               data-component="body">
    <br>
<p>User email address (must be unique). Must be a valid email address. Must not be greater than 255 characters. Example: <code>user@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-auth-register"
               value="Password123!"
               data-component="body">
    <br>
<p>User password (minimum 8 characters, must contain uppercase, lowercase, number, and special character). Must match the regex /^(?=.<em>[a-z])(?=.</em>[A-Z])(?=.<em>\d)(?=.</em>[!@#\$٪\^&amp;*)(ـ+])[A-Za-z\d!@#\$٪\^&amp;*)(ـ+]{8,}$/u. Must be at least 8 characters. Example: <code>Password123!</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="type"                data-endpoint="POSTapi-auth-register"
               value="freelancer"
               data-component="body">
    <br>
<p>User type (freelancer or client). Example: <code>freelancer</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>freelancer</code></li> <li><code>client</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>linkedin_link</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="linkedin_link"                data-endpoint="POSTapi-auth-register"
               value="https://linkedin.com/in/johndoe"
               data-component="body">
    <br>
<p>LinkedIn profile URL (required if type is freelancer). This field is required when <code>type</code> is <code>freelancer</code>. Must be a valid URL. Example: <code>https://linkedin.com/in/johndoe</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>twitter_link</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="twitter_link"                data-endpoint="POSTapi-auth-register"
               value="https://twitter.com/johndoe"
               data-component="body">
    <br>
<p>Twitter profile URL (required if type is freelancer). This field is required when <code>type</code> is <code>freelancer</code>. Must be a valid URL. Example: <code>https://twitter.com/johndoe</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>other_freelance_platform_links</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="other_freelance_platform_links[0]"                data-endpoint="POSTapi-auth-register"
               data-component="body">
        <input type="text" style="display: none"
               name="other_freelance_platform_links[1]"                data-endpoint="POSTapi-auth-register"
               data-component="body">
    <br>
<p>Must be a valid URL.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>portfolio_link</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="portfolio_link"                data-endpoint="POSTapi-auth-register"
               value="https://johndoe.com"
               data-component="body">
    <br>
<p>Portfolio website URL (required if type is freelancer). This field is required when <code>type</code> is <code>freelancer</code>. Must be a valid URL. Example: <code>https://johndoe.com</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-auth-resend-code">Resend Verification Code.</h2>

<p>
</p>



<span id="example-requests-POSTapi-auth-resend-code">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://backend.shuwier.com/api/auth/resend-code" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en" \
    --data "{
    \"email\": \"qkunze@example.com\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/auth/resend-code"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

let body = {
    "email": "qkunze@example.com"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-auth-resend-code">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Verification code resent successfully&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;Email not found or already verified&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The email field is required.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-auth-resend-code" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-auth-resend-code"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-auth-resend-code"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-auth-resend-code" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-auth-resend-code">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-auth-resend-code" data-method="POST"
      data-path="api/auth/resend-code"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-auth-resend-code', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-auth-resend-code"
                    onclick="tryItOut('POSTapi-auth-resend-code');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-auth-resend-code"
                    onclick="cancelTryOut('POSTapi-auth-resend-code');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-auth-resend-code"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/auth/resend-code</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-auth-resend-code"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-auth-resend-code"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="POSTapi-auth-resend-code"
               value="en"
               data-component="header">
    <br>
<p>Example: <code>en</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-auth-resend-code"
               value="qkunze@example.com"
               data-component="body">
    <br>
<p>Must be a valid email address. Example: <code>qkunze@example.com</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-auth-verify-email">Verify Email and Complete Registration.</h2>

<p>
</p>

<p>This endpoint verifies the email OTP code sent during registration and completes the user account creation.
For freelancers, the account will be created with &quot;requested&quot; approval status and require admin approval.
For clients, the account will be immediately approved and ready to use.</p>

<span id="example-requests-POSTapi-auth-verify-email">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://backend.shuwier.com/api/auth/verify-email" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en" \
    --data "{
    \"email\": \"user@example.com\",
    \"otp\": \"1234\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/auth/verify-email"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

let body = {
    "email": "user@example.com",
    "otp": "1234"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-auth-verify-email">
            <blockquote>
            <p>Example response (200, Freelancer registration completed):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;User registered successfully&quot;,
    &quot;data&quot;: {
        &quot;user&quot;: {
            &quot;id&quot;: 1,
            &quot;first_name&quot;: &quot;John&quot;,
            &quot;last_name&quot;: &quot;Doe&quot;,
            &quot;email&quot;: &quot;john@example.com&quot;,
            &quot;type&quot;: &quot;freelancer&quot;,
            &quot;email_verified_at&quot;: &quot;2025-08-24T10:30:00.000000Z&quot;,
            &quot;phone&quot;: null,
            &quot;is_active&quot;: true,
            &quot;about_me&quot;: null,
            &quot;profile_picture&quot;: null,
            &quot;approval_status&quot;: &quot;requested&quot;,
            &quot;linkedin_link&quot;: &quot;https://linkedin.com/in/johndoe&quot;,
            &quot;twitter_link&quot;: &quot;https://twitter.com/johndoe&quot;,
            &quot;other_freelance_platform_links&quot;: [
                &quot;https://upwork.com/freelancers/johndoe&quot;
            ],
            &quot;portfolio_link&quot;: &quot;https://johndoe.com&quot;,
            &quot;headline&quot;: null,
            &quot;description&quot;: null,
            &quot;created_at&quot;: &quot;2025-08-24T10:30:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-08-24T10:30:00.000000Z&quot;
        },
        &quot;token&quot;: &quot;eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (200, Client registration completed):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;User registered successfully&quot;,
    &quot;data&quot;: {
        &quot;user&quot;: {
            &quot;id&quot;: 2,
            &quot;first_name&quot;: &quot;Jane&quot;,
            &quot;last_name&quot;: &quot;Smith&quot;,
            &quot;email&quot;: &quot;jane@example.com&quot;,
            &quot;email_verified_at&quot;: &quot;2025-08-24T10:30:00.000000Z&quot;,
            &quot;phone&quot;: null,
            &quot;type&quot;: &quot;client&quot;,
            &quot;is_active&quot;: true,
            &quot;about_me&quot;: null,
            &quot;profile_picture&quot;: null,
            &quot;company&quot;: null,
            &quot;created_at&quot;: &quot;2025-08-24T10:30:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-08-24T10:30:00.000000Z&quot;
        },
        &quot;token&quot;: &quot;eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (200, Password reset verification):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Email verification successful&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;Invalid or expired verification code&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The otp field is required.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-auth-verify-email" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-auth-verify-email"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-auth-verify-email"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-auth-verify-email" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-auth-verify-email">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-auth-verify-email" data-method="POST"
      data-path="api/auth/verify-email"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-auth-verify-email', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-auth-verify-email"
                    onclick="tryItOut('POSTapi-auth-verify-email');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-auth-verify-email"
                    onclick="cancelTryOut('POSTapi-auth-verify-email');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-auth-verify-email"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/auth/verify-email</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-auth-verify-email"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-auth-verify-email"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="POSTapi-auth-verify-email"
               value="en"
               data-component="header">
    <br>
<p>Example: <code>en</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-auth-verify-email"
               value="user@example.com"
               data-component="body">
    <br>
<p>The email address to verify. Example: <code>user@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>otp</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="otp"                data-endpoint="POSTapi-auth-verify-email"
               value="1234"
               data-component="body">
    <br>
<p>The 4-digit verification code sent to email. Example: <code>1234</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-auth-reset-email">Reset Email Address.</h2>

<p>
</p>



<span id="example-requests-POSTapi-auth-reset-email">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://backend.shuwier.com/api/auth/reset-email" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en" \
    --data "{
    \"old_email\": \"old@example.com\",
    \"new_email\": \"new@example.com\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/auth/reset-email"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

let body = {
    "old_email": "old@example.com",
    "new_email": "new@example.com"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-auth-reset-email">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
  &quot;status&quot;: true,
  &quot;error_num&quot;: null,
  &quot;message&quot;: &quot;Email reset successfully&quot;,
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;Old email not found or new email already exists&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The old_email field is required.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-auth-reset-email" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-auth-reset-email"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-auth-reset-email"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-auth-reset-email" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-auth-reset-email">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-auth-reset-email" data-method="POST"
      data-path="api/auth/reset-email"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-auth-reset-email', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-auth-reset-email"
                    onclick="tryItOut('POSTapi-auth-reset-email');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-auth-reset-email"
                    onclick="cancelTryOut('POSTapi-auth-reset-email');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-auth-reset-email"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/auth/reset-email</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-auth-reset-email"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-auth-reset-email"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="POSTapi-auth-reset-email"
               value="en"
               data-component="header">
    <br>
<p>Example: <code>en</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>old_email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="old_email"                data-endpoint="POSTapi-auth-reset-email"
               value="old@example.com"
               data-component="body">
    <br>
<p>Current email address. Must be a valid email address. Example: <code>old@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>new_email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="new_email"                data-endpoint="POSTapi-auth-reset-email"
               value="new@example.com"
               data-component="body">
    <br>
<p>New email address (must be different from old email). The value and <code>old_email</code> must be different. Must be a valid email address. Example: <code>new@example.com</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-auth-login">Client Login.</h2>

<p>
</p>

<p>This endpoint authenticates client users and returns a JWT token.</p>

<span id="example-requests-POSTapi-auth-login">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://backend.shuwier.com/api/auth/login" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en" \
    --data "{
    \"email\": \"client@example.com\",
    \"password\": \"password123\",
    \"type\": \"client\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/auth/login"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

let body = {
    "email": "client@example.com",
    "password": "password123",
    "type": "client"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-auth-login">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Login successful&quot;,
    &quot;user&quot;: {
        &quot;id&quot;: 2,
        &quot;first_name&quot;: &quot;Jane&quot;,
        &quot;last_name&quot;: &quot;Smith&quot;,
        &quot;email&quot;: &quot;jane@example.com&quot;,
        &quot;email_verified_at&quot;: &quot;2025-08-24T10:30:00.000000Z&quot;,
        &quot;phone&quot;: null,
        &quot;type&quot;: &quot;client&quot;,
        &quot;is_active&quot;: true,
        &quot;about_me&quot;: null,
        &quot;profile_picture&quot;: null,
        &quot;company&quot;: null,
        &quot;created_at&quot;: &quot;2025-08-24T10:30:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-08-24T10:30:00.000000Z&quot;
    },
    &quot;token&quot;: &quot;eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The email field is required.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 401,
    &quot;message&quot;: &quot;Invalid password&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Account blocked):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 403,
    &quot;message&quot;: &quot;Account is blocked&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Email not verified):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 403,
    &quot;message&quot;: &quot;Email is not verified&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-auth-login" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-auth-login"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-auth-login"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-auth-login" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-auth-login">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-auth-login" data-method="POST"
      data-path="api/auth/login"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-auth-login', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-auth-login"
                    onclick="tryItOut('POSTapi-auth-login');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-auth-login"
                    onclick="cancelTryOut('POSTapi-auth-login');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-auth-login"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/auth/login</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-auth-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-auth-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="POSTapi-auth-login"
               value="en"
               data-component="header">
    <br>
<p>Example: <code>en</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-auth-login"
               value="client@example.com"
               data-component="body">
    <br>
<p>Client email address. Example: <code>client@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-auth-login"
               value="password123"
               data-component="body">
    <br>
<p>Client password (minimum 6 characters). Example: <code>password123</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="type"                data-endpoint="POSTapi-auth-login"
               value="client"
               data-component="body">
    <br>
<p>User type (client or freelancer). Example: <code>client</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>client</code></li> <li><code>freelancer</code></li></ul>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-auth-forget-password">Forget Password - Send Reset Code.</h2>

<p>
</p>



<span id="example-requests-POSTapi-auth-forget-password">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://backend.shuwier.com/api/auth/forget-password" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en" \
    --data "{
    \"email\": \"qkunze@example.com\",
    \"type\": \"freelancer\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/auth/forget-password"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

let body = {
    "email": "qkunze@example.com",
    "type": "freelancer"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-auth-forget-password">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Verification code sent successfully&quot;,
    &quot;data&quot;: {
        &quot;token&quot;: &quot;abc123def456ghi789jkl012mno345pqr678stu901vwx234yz567890&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;Email not found&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The email field is required.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-auth-forget-password" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-auth-forget-password"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-auth-forget-password"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-auth-forget-password" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-auth-forget-password">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-auth-forget-password" data-method="POST"
      data-path="api/auth/forget-password"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-auth-forget-password', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-auth-forget-password"
                    onclick="tryItOut('POSTapi-auth-forget-password');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-auth-forget-password"
                    onclick="cancelTryOut('POSTapi-auth-forget-password');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-auth-forget-password"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/auth/forget-password</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-auth-forget-password"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-auth-forget-password"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="POSTapi-auth-forget-password"
               value="en"
               data-component="header">
    <br>
<p>Example: <code>en</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-auth-forget-password"
               value="qkunze@example.com"
               data-component="body">
    <br>
<p>Must be a valid email address. The <code>email</code> of an existing record in the users table. Example: <code>qkunze@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="type"                data-endpoint="POSTapi-auth-forget-password"
               value="freelancer"
               data-component="body">
    <br>
<p>Example: <code>freelancer</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>client</code></li> <li><code>freelancer</code></li></ul>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-auth-reset-password">Reset Password.</h2>

<p>
</p>



<span id="example-requests-POSTapi-auth-reset-password">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://backend.shuwier.com/api/auth/reset-password" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en" \
    --data "{
    \"email\": \"user@example.com\",
    \"token\": \"abc123def456ghi789jkl012mno345pqr678stu901vwx234yz567890\",
    \"password\": \"NewPassword123!\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/auth/reset-password"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

let body = {
    "email": "user@example.com",
    "token": "abc123def456ghi789jkl012mno345pqr678stu901vwx234yz567890",
    "password": "NewPassword123!"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-auth-reset-password">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Password reset successfully&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;Verification session expired&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;Verification code not verified&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;Invalid token&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The email field is required.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-auth-reset-password" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-auth-reset-password"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-auth-reset-password"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-auth-reset-password" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-auth-reset-password">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-auth-reset-password" data-method="POST"
      data-path="api/auth/reset-password"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-auth-reset-password', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-auth-reset-password"
                    onclick="tryItOut('POSTapi-auth-reset-password');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-auth-reset-password"
                    onclick="cancelTryOut('POSTapi-auth-reset-password');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-auth-reset-password"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/auth/reset-password</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-auth-reset-password"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-auth-reset-password"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="POSTapi-auth-reset-password"
               value="en"
               data-component="header">
    <br>
<p>Example: <code>en</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-auth-reset-password"
               value="user@example.com"
               data-component="body">
    <br>
<p>User email address. Must be a valid email address. The <code>email</code> of an existing record in the users table. Example: <code>user@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>token</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="token"                data-endpoint="POSTapi-auth-reset-password"
               value="abc123def456ghi789jkl012mno345pqr678stu901vwx234yz567890"
               data-component="body">
    <br>
<p>Password reset token received from forget password request. Example: <code>abc123def456ghi789jkl012mno345pqr678stu901vwx234yz567890</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-auth-reset-password"
               value="NewPassword123!"
               data-component="body">
    <br>
<p>New password (minimum 8 characters, must contain uppercase, lowercase, number, and special character). Must match the regex /^(?=.<em>[a-z])(?=.</em>[A-Z])(?=.<em>\d)(?=.</em>[!@#\$٪\^&amp;*)(ـ+])[A-Za-z\d!@#\$٪\^&amp;*)(ـ+]{8,}$/u. Must be at least 8 characters. Example: <code>NewPassword123!</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-auth-logout">User Logout.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-auth-logout">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://backend.shuwier.com/api/auth/logout" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/auth/logout"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-auth-logout">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Logout successful&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 401,
    &quot;message&quot;: &quot;Unauthenticated&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-auth-logout" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-auth-logout"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-auth-logout"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-auth-logout" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-auth-logout">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-auth-logout" data-method="POST"
      data-path="api/auth/logout"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-auth-logout', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-auth-logout"
                    onclick="tryItOut('POSTapi-auth-logout');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-auth-logout"
                    onclick="cancelTryOut('POSTapi-auth-logout');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-auth-logout"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/auth/logout</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-auth-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-auth-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="POSTapi-auth-logout"
               value="en"
               data-component="header">
    <br>
<p>Example: <code>en</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-auth-refresh">Refresh Token.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-auth-refresh">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://backend.shuwier.com/api/auth/refresh" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/auth/refresh"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-auth-refresh">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Token refreshed successfully&quot;,
    &quot;data&quot;: {
        &quot;token&quot;: &quot;eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 401,
    &quot;message&quot;: &quot;Unauthenticated&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-auth-refresh" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-auth-refresh"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-auth-refresh"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-auth-refresh" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-auth-refresh">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-auth-refresh" data-method="POST"
      data-path="api/auth/refresh"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-auth-refresh', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-auth-refresh"
                    onclick="tryItOut('POSTapi-auth-refresh');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-auth-refresh"
                    onclick="cancelTryOut('POSTapi-auth-refresh');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-auth-refresh"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/auth/refresh</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-auth-refresh"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-auth-refresh"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="POSTapi-auth-refresh"
               value="en"
               data-component="header">
    <br>
<p>Example: <code>en</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-admin-auth-login">Admin Login.</h2>

<p>
</p>



<span id="example-requests-POSTapi-admin-auth-login">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://backend.shuwier.com/api/admin/auth/login" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en" \
    --data "{
    \"email\": \"admin@admin.com\",
    \"password\": \"password123\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/admin/auth/login"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

let body = {
    "email": "admin@admin.com",
    "password": "password123"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-admin-auth-login">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
  &quot;status&quot;: true,
  &quot;error_num&quot;: null,
  &quot;message&quot;: &quot;Login successful&quot;,
  &quot;data&quot;: {
    &quot;admin&quot;: {
      &quot;id&quot;: 1,
      &quot;email&quot;: &quot;admin@admin.com&quot;,
      &quot;permissions_with_role&quot;: {
        &quot;permissions&quot;: [
          &quot;admin.users.index&quot;,
          &quot;admin.users.create&quot;,
          &quot;admin.users.edit&quot;,
          &quot;admin.users.delete&quot;,
        ],
        &quot;role&quot;: &quot;super-admin&quot;,
      },
      &quot;created_at&quot;: &quot;2025-08-21T07:43:34.000000Z&quot;,
      &quot;updated_at&quot;: &quot;2025-08-21T07:43:34.000000Z&quot;
    },
    &quot;token&quot;: &quot;eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...&quot;
  }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;Invalid password&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 404,
    &quot;message&quot;: &quot;The Selected email was is invalid.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-admin-auth-login" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-admin-auth-login"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-admin-auth-login"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-admin-auth-login" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-admin-auth-login">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-admin-auth-login" data-method="POST"
      data-path="api/admin/auth/login"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-admin-auth-login', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-admin-auth-login"
                    onclick="tryItOut('POSTapi-admin-auth-login');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-admin-auth-login"
                    onclick="cancelTryOut('POSTapi-admin-auth-login');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-admin-auth-login"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/admin/auth/login</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-admin-auth-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-admin-auth-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="POSTapi-admin-auth-login"
               value="en"
               data-component="header">
    <br>
<p>Example: <code>en</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-admin-auth-login"
               value="admin@admin.com"
               data-component="body">
    <br>
<p>Admin email address. Must be a valid email address. The <code>email</code> of an existing record in the admins table. Example: <code>admin@admin.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-admin-auth-login"
               value="password123"
               data-component="body">
    <br>
<p>Admin password (minimum 6 characters). Must be at least 6 characters. Example: <code>password123</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-admin-freelancers">Display a listing of freelancers with optional filters.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-admin-freelancers">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://backend.shuwier.com/api/admin/freelancers?approval_status=requested&amp;is_active=1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en" \
    --data "{
    \"approval_status\": \"requested\",
    \"is_active\": \"1\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/admin/freelancers"
);

const params = {
    "approval_status": "requested",
    "is_active": "1",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

let body = {
    "approval_status": "requested",
    "is_active": "1"
};

fetch(url, {
    method: "GET",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-admin-freelancers">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Success&quot;,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;first_name&quot;: &quot;John&quot;,
            &quot;last_name&quot;: &quot;Doe&quot;,
            &quot;email&quot;: &quot;john@example.com&quot;,
            &quot;type&quot;: &quot;freelancer&quot;,
            &quot;email_verified_at&quot;: &quot;2025-08-24T10:30:00.000000Z&quot;,
            &quot;phone&quot;: null,
            &quot;is_active&quot;: true,
            &quot;about_me&quot;: null,
            &quot;profile_picture&quot;: null,
            &quot;approval_status&quot;: &quot;requested&quot;,
            &quot;linkedin_link&quot;: &quot;https://linkedin.com/in/johndoe&quot;,
            &quot;twitter_link&quot;: &quot;https://twitter.com/johndoe&quot;,
            &quot;other_freelance_platform_links&quot;: [
                &quot;https://upwork.com/freelancers/johndoe&quot;
            ],
            &quot;portfolio_link&quot;: &quot;https://johndoe.com&quot;,
            &quot;headline&quot;: null,
            &quot;description&quot;: null,
            &quot;created_at&quot;: &quot;2025-08-24T10:30:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-08-24T10:30:00.000000Z&quot;
        }
    ],
    &quot;current_page&quot;: 1,
    &quot;from&quot;: 1,
    &quot;last_page&quot;: 5,
    &quot;per_page&quot;: 10,
    &quot;to&quot;: 10,
    &quot;total&quot;: 50,
    &quot;links&quot;: {
        &quot;first&quot;: &quot;http://localhost/api/admin/freelancers?page=1&quot;,
        &quot;last&quot;: &quot;http://localhost/api/admin/freelancers?page=5&quot;,
        &quot;prev&quot;: null,
        &quot;next&quot;: &quot;http://localhost/api/admin/freelancers?page=2&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The approval_status field must be one of: requested, approved.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 401,
    &quot;message&quot;: &quot;Unauthenticated&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 403,
    &quot;message&quot;: &quot;You don&#039;t have permission to access this resource&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-freelancers" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-freelancers"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-freelancers"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-freelancers" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-freelancers">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-freelancers" data-method="GET"
      data-path="api/admin/freelancers"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-freelancers', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-freelancers"
                    onclick="tryItOut('GETapi-admin-freelancers');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-freelancers"
                    onclick="cancelTryOut('GETapi-admin-freelancers');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-freelancers"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/freelancers</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-freelancers"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-admin-freelancers"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="GETapi-admin-freelancers"
               value="en"
               data-component="header">
    <br>
<p>Example: <code>en</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>approval_status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="approval_status"                data-endpoint="GETapi-admin-freelancers"
               value="requested"
               data-component="query">
    <br>
<p>Optional filter by approval status (requested, approved). Example: <code>requested</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>is_active</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="is_active"                data-endpoint="GETapi-admin-freelancers"
               value="1"
               data-component="query">
    <br>
<p>Optional filter by active status (0 or 1). Example: <code>1</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>approval_status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="approval_status"                data-endpoint="GETapi-admin-freelancers"
               value="requested"
               data-component="body">
    <br>
<p>Example: <code>requested</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>requested</code></li> <li><code>approved</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>is_active</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="is_active"                data-endpoint="GETapi-admin-freelancers"
               value="1"
               data-component="body">
    <br>
<p>Example: <code>1</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>0</code></li> <li><code>1</code></li></ul>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-admin-freelancers-approve-reject--id-">Approve or Reject a freelancer application.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>This endpoint allows admins to approve or reject freelancer applications.
When approving, the freelancer receives an email notification and can start working.
When rejecting, the freelancer account is permanently deleted.</p>

<span id="example-requests-POSTapi-admin-freelancers-approve-reject--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://backend.shuwier.com/api/admin/freelancers/approve-reject/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en" \
    --data "{
    \"action\": \"approve\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/admin/freelancers/approve-reject/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

let body = {
    "action": "approve"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-admin-freelancers-approve-reject--id-">
            <blockquote>
            <p>Example response (200, Freelancer approved successfully):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Freelancer approved successfully&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 14,
        &quot;first_name&quot;: &quot;احمد&quot;,
        &quot;last_name&quot;: &quot;حسني&quot;,
        &quot;email&quot;: &quot;abdelrahmanelghonemypomac@gmail.com&quot;,
        &quot;type&quot;: &quot;freelancer&quot;,
        &quot;email_verified_at&quot;: &quot;2025-08-26T09:09:53.000000Z&quot;,
        &quot;phone&quot;: null,
        &quot;is_active&quot;: true,
        &quot;about_me&quot;: null,
        &quot;profile_picture&quot;: null,
        &quot;approval_status&quot;: &quot;approved&quot;,
        &quot;linkedin_link&quot;: &quot;https://www.linkedin.com/in/muhammed-yousry96?lipi=urn%3Ali%3Apage%3Ad_flagship3_profile_view_base%3BXWDAHlI8QB2HsM6PFNaclA%3D%3D&quot;,
        &quot;twitter_link&quot;: &quot;https://www.facebook.com/ahmedhosni516&quot;,
        &quot;other_freelance_platform_links&quot;: [
            &quot;https://www.google.com&quot;,
            &quot;https://www.google.com&quot;
        ],
        &quot;portfolio_link&quot;: &quot;https://www.facebook.com/ahmedhosni516&quot;,
        &quot;headline&quot;: null,
        &quot;description&quot;: null,
        &quot;created_at&quot;: &quot;2025-08-26T09:09:53.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-08-27T08:49:50.000000Z&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (200, Freelancer rejected successfully):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Freelancer rejected successfully&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Freelancer already approved):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;Freelancer already approved&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Invalid action parameter):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The action field is required.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 401,
    &quot;message&quot;: &quot;Unauthenticated&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 403,
    &quot;message&quot;: &quot;You don&#039;t have permission to access this resource&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 404,
    &quot;message&quot;: &quot;Freelancer not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-admin-freelancers-approve-reject--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-admin-freelancers-approve-reject--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-admin-freelancers-approve-reject--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-admin-freelancers-approve-reject--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-admin-freelancers-approve-reject--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-admin-freelancers-approve-reject--id-" data-method="POST"
      data-path="api/admin/freelancers/approve-reject/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-admin-freelancers-approve-reject--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-admin-freelancers-approve-reject--id-"
                    onclick="tryItOut('POSTapi-admin-freelancers-approve-reject--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-admin-freelancers-approve-reject--id-"
                    onclick="cancelTryOut('POSTapi-admin-freelancers-approve-reject--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-admin-freelancers-approve-reject--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/admin/freelancers/approve-reject/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-admin-freelancers-approve-reject--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-admin-freelancers-approve-reject--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="POSTapi-admin-freelancers-approve-reject--id-"
               value="en"
               data-component="header">
    <br>
<p>Example: <code>en</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="POSTapi-admin-freelancers-approve-reject--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the freelancer to approve/reject. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>action</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="action"                data-endpoint="POSTapi-admin-freelancers-approve-reject--id-"
               value="approve"
               data-component="body">
    <br>
<p>The action to perform. Must be either &quot;approve&quot; or &quot;reject&quot;. Example: <code>approve</code></p>
        </div>
        </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
