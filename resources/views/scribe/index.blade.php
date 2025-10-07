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
                    <ul id="tocify-header-admin-authentication" class="tocify-header">
                <li class="tocify-item level-1" data-unique="admin-authentication">
                    <a href="#admin-authentication">Admin Authentication</a>
                </li>
                                    <ul id="tocify-subheader-admin-authentication" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="admin-authentication-POSTapi-admin-auth-login">
                                <a href="#admin-authentication-POSTapi-admin-auth-login">Admin Login.</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-admin-category-management" class="tocify-header">
                <li class="tocify-item level-1" data-unique="admin-category-management">
                    <a href="#admin-category-management">Admin Category Management</a>
                </li>
                                    <ul id="tocify-subheader-admin-category-management" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="admin-category-management-GETapi-admin-categories">
                                <a href="#admin-category-management-GETapi-admin-categories">List categories with optional filters and pagination.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-category-management-POSTapi-admin-categories">
                                <a href="#admin-category-management-POSTapi-admin-categories">Create a new category.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-category-management-GETapi-admin-categories--id-">
                                <a href="#admin-category-management-GETapi-admin-categories--id-">Show category details by ID.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-category-management-PUTapi-admin-categories--id-">
                                <a href="#admin-category-management-PUTapi-admin-categories--id-">Update a category by ID.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-category-management-DELETEapi-admin-categories--id-">
                                <a href="#admin-category-management-DELETEapi-admin-categories--id-">Delete a category by ID.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-category-management-POSTapi-admin-categories-store-all-with-childrens">
                                <a href="#admin-category-management-POSTapi-admin-categories-store-all-with-childrens">Bulk create categories with children.</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-admin-client-management" class="tocify-header">
                <li class="tocify-item level-1" data-unique="admin-client-management">
                    <a href="#admin-client-management">Admin Client Management</a>
                </li>
                                    <ul id="tocify-subheader-admin-client-management" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="admin-client-management-GETapi-admin-clients">
                                <a href="#admin-client-management-GETapi-admin-clients">Display a listing of clients with optional filters.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-client-management-GETapi-admin-clients--id-">
                                <a href="#admin-client-management-GETapi-admin-clients--id-">Display the specified client details.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-client-management-DELETEapi-admin-clients--id-">
                                <a href="#admin-client-management-DELETEapi-admin-clients--id-">Delete a client account permanently.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-client-management-POSTapi-admin-clients-block-unblock--id-">
                                <a href="#admin-client-management-POSTapi-admin-clients-block-unblock--id-">Block or Unblock a client account.</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-admin-commission-management" class="tocify-header">
                <li class="tocify-item level-1" data-unique="admin-commission-management">
                    <a href="#admin-commission-management">Admin Commission Management</a>
                </li>
                                    <ul id="tocify-subheader-admin-commission-management" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="admin-commission-management-GETapi-admin-commissions">
                                <a href="#admin-commission-management-GETapi-admin-commissions">List commissions</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-commission-management-POSTapi-admin-commissions">
                                <a href="#admin-commission-management-POSTapi-admin-commissions">Create commission</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-admin-freelancer-invitations" class="tocify-header">
                <li class="tocify-item level-1" data-unique="admin-freelancer-invitations">
                    <a href="#admin-freelancer-invitations">Admin Freelancer Invitations</a>
                </li>
                                    <ul id="tocify-subheader-admin-freelancer-invitations" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="admin-freelancer-invitations-GETapi-admin-invitations">
                                <a href="#admin-freelancer-invitations-GETapi-admin-invitations">Get All Freelancer Invitations</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-freelancer-invitations-POSTapi-admin-invitations">
                                <a href="#admin-freelancer-invitations-POSTapi-admin-invitations">Send Freelancer Invitation</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-admin-freelancer-management" class="tocify-header">
                <li class="tocify-item level-1" data-unique="admin-freelancer-management">
                    <a href="#admin-freelancer-management">Admin Freelancer Management</a>
                </li>
                                    <ul id="tocify-subheader-admin-freelancer-management" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="admin-freelancer-management-GETapi-admin-freelancers">
                                <a href="#admin-freelancer-management-GETapi-admin-freelancers">Display a listing of freelancers with optional filters.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-freelancer-management-GETapi-admin-freelancers--id-">
                                <a href="#admin-freelancer-management-GETapi-admin-freelancers--id-">Display the specified freelancer details.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-freelancer-management-DELETEapi-admin-freelancers--id-">
                                <a href="#admin-freelancer-management-DELETEapi-admin-freelancers--id-">Delete a freelancer account permanently.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-freelancer-management-POSTapi-admin-freelancers-approve-reject--id-">
                                <a href="#admin-freelancer-management-POSTapi-admin-freelancers-approve-reject--id-">Approve or Reject a freelancer application.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-freelancer-management-POSTapi-admin-freelancers-block-unblock--id-">
                                <a href="#admin-freelancer-management-POSTapi-admin-freelancers-block-unblock--id-">Block or Unblock a freelancer account.</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-admin-skills-management" class="tocify-header">
                <li class="tocify-item level-1" data-unique="admin-skills-management">
                    <a href="#admin-skills-management">Admin Skills Management</a>
                </li>
                                    <ul id="tocify-subheader-admin-skills-management" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="admin-skills-management-GETapi-admin-skills">
                                <a href="#admin-skills-management-GETapi-admin-skills">Get All Skills</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-skills-management-POSTapi-admin-skills">
                                <a href="#admin-skills-management-POSTapi-admin-skills">Create New Skill</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-skills-management-GETapi-admin-skills--id-">
                                <a href="#admin-skills-management-GETapi-admin-skills--id-">Get Skill Details</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-skills-management-PUTapi-admin-skills--id-">
                                <a href="#admin-skills-management-PUTapi-admin-skills--id-">Update Skill</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-skills-management-DELETEapi-admin-skills--id-">
                                <a href="#admin-skills-management-DELETEapi-admin-skills--id-">Delete Skill</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-admin-user-verification" class="tocify-header">
                <li class="tocify-item level-1" data-unique="admin-user-verification">
                    <a href="#admin-user-verification">Admin User Verification</a>
                </li>
                                    <ul id="tocify-subheader-admin-user-verification" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="admin-user-verification-GETapi-admin-verifications">
                                <a href="#admin-user-verification-GETapi-admin-verifications">Get User Verification Requests</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-user-verification-POSTapi-admin-verifications--id-">
                                <a href="#admin-user-verification-POSTapi-admin-verifications--id-">Accept or Reject User Verification</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-categories" class="tocify-header">
                <li class="tocify-item level-1" data-unique="categories">
                    <a href="#categories">Categories</a>
                </li>
                                    <ul id="tocify-subheader-categories" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="categories-GETapi-categories">
                                <a href="#categories-GETapi-categories">Get all parent categories</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="categories-GETapi-categories-child--id-">
                                <a href="#categories-GETapi-categories-child--id-">Get subcategories</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-client-project-management" class="tocify-header">
                <li class="tocify-item level-1" data-unique="client-project-management">
                    <a href="#client-project-management">Client Project Management</a>
                </li>
                                    <ul id="tocify-subheader-client-project-management" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="client-project-management-GETapi-clients-projects">
                                <a href="#client-project-management-GETapi-clients-projects">List client projects</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="client-project-management-POSTapi-clients-projects">
                                <a href="#client-project-management-POSTapi-clients-projects">Create new project</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="client-project-management-GETapi-clients-projects--id-">
                                <a href="#client-project-management-GETapi-clients-projects--id-">Show project details</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="client-project-management-POSTapi-clients-projects--id--end">
                                <a href="#client-project-management-POSTapi-clients-projects--id--end">End project</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-client-proposal-management" class="tocify-header">
                <li class="tocify-item level-1" data-unique="client-proposal-management">
                    <a href="#client-proposal-management">Client Proposal Management</a>
                </li>
                                    <ul id="tocify-subheader-client-proposal-management" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="client-proposal-management-GETapi-clients-projects--projectId--proposals">
                                <a href="#client-proposal-management-GETapi-clients-projects--projectId--proposals">List project proposals</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="client-proposal-management-GETapi-clients-proposals--id-">
                                <a href="#client-proposal-management-GETapi-clients-proposals--id-">Show proposal details</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-commissions" class="tocify-header">
                <li class="tocify-item level-1" data-unique="commissions">
                    <a href="#commissions">Commissions</a>
                </li>
                                    <ul id="tocify-subheader-commissions" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="commissions-GETapi-commissions">
                                <a href="#commissions-GETapi-commissions">Get current commission rates</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-endpoints" class="tocify-header">
                <li class="tocify-item level-1" data-unique="endpoints">
                    <a href="#endpoints">Endpoints</a>
                </li>
                                    <ul id="tocify-subheader-endpoints" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="endpoints-GETapi-freelancers-proposals--id-">
                                <a href="#endpoints-GETapi-freelancers-proposals--id-">GET api/freelancers/proposals/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-services--id-">
                                <a href="#endpoints-GETapi-services--id-">GET api/services/{id}</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-file-upload" class="tocify-header">
                <li class="tocify-item level-1" data-unique="file-upload">
                    <a href="#file-upload">File Upload</a>
                </li>
                                    <ul id="tocify-subheader-file-upload" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="file-upload-POSTapi-upload">
                                <a href="#file-upload-POSTapi-upload">Upload file</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-freelancer-projects" class="tocify-header">
                <li class="tocify-item level-1" data-unique="freelancer-projects">
                    <a href="#freelancer-projects">Freelancer Projects</a>
                </li>
                                    <ul id="tocify-subheader-freelancer-projects" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="freelancer-projects-GETapi-freelancers-projects--id-">
                                <a href="#freelancer-projects-GETapi-freelancers-projects--id-">Show project details to freelancer</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-freelancer-proposals" class="tocify-header">
                <li class="tocify-item level-1" data-unique="freelancer-proposals">
                    <a href="#freelancer-proposals">Freelancer Proposals</a>
                </li>
                                    <ul id="tocify-subheader-freelancer-proposals" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="freelancer-proposals-GETapi-freelancers-proposals">
                                <a href="#freelancer-proposals-GETapi-freelancers-proposals">List freelancer proposals</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="freelancer-proposals-POSTapi-freelancers-proposals">
                                <a href="#freelancer-proposals-POSTapi-freelancers-proposals">Store Proposal</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-hashtags" class="tocify-header">
                <li class="tocify-item level-1" data-unique="hashtags">
                    <a href="#hashtags">Hashtags</a>
                </li>
                                    <ul id="tocify-subheader-hashtags" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="hashtags-GETapi-hashtags">
                                <a href="#hashtags-GETapi-hashtags">Search hashtags</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-languages" class="tocify-header">
                <li class="tocify-item level-1" data-unique="languages">
                    <a href="#languages">Languages</a>
                </li>
                                    <ul id="tocify-subheader-languages" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="languages-GETapi-languages">
                                <a href="#languages-GETapi-languages">Get All Languages</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-portfolio-management" class="tocify-header">
                <li class="tocify-item level-1" data-unique="portfolio-management">
                    <a href="#portfolio-management">Portfolio Management</a>
                </li>
                                    <ul id="tocify-subheader-portfolio-management" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="portfolio-management-GETapi-freelancers-portfolios">
                                <a href="#portfolio-management-GETapi-freelancers-portfolios">Get user portfolios</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="portfolio-management-POSTapi-freelancers-portfolios">
                                <a href="#portfolio-management-POSTapi-freelancers-portfolios">Create new portfolio</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="portfolio-management-GETapi-freelancers-portfolios--id-">
                                <a href="#portfolio-management-GETapi-freelancers-portfolios--id-">Get specific portfolio</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="portfolio-management-PUTapi-freelancers-portfolios--id-">
                                <a href="#portfolio-management-PUTapi-freelancers-portfolios--id-">Update portfolio</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="portfolio-management-DELETEapi-freelancers-portfolios--id-">
                                <a href="#portfolio-management-DELETEapi-freelancers-portfolios--id-">Delete portfolio</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-public-home-page" class="tocify-header">
                <li class="tocify-item level-1" data-unique="public-home-page">
                    <a href="#public-home-page">Public Home Page</a>
                </li>
                                    <ul id="tocify-subheader-public-home-page" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="public-home-page-GETapi-home-guest">
                                <a href="#public-home-page-GETapi-home-guest">Guest home page</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="public-home-page-GETapi-home-freelancer">
                                <a href="#public-home-page-GETapi-home-freelancer">Freelancer Home Page</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="public-home-page-GETapi-home-client">
                                <a href="#public-home-page-GETapi-home-client">Client homepage</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-public-search" class="tocify-header">
                <li class="tocify-item level-1" data-unique="public-search">
                    <a href="#public-search">Public Search</a>
                </li>
                                    <ul id="tocify-subheader-public-search" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="public-search-GETapi-search-service">
                                <a href="#public-search-GETapi-search-service">Search services</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-service-management" class="tocify-header">
                <li class="tocify-item level-1" data-unique="service-management">
                    <a href="#service-management">Service Management</a>
                </li>
                                    <ul id="tocify-subheader-service-management" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="service-management-GETapi-freelancers-services">
                                <a href="#service-management-GETapi-freelancers-services">Get freelancer services</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="service-management-POSTapi-freelancers-services">
                                <a href="#service-management-POSTapi-freelancers-services">Create new service</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="service-management-GETapi-freelancers-services--id-">
                                <a href="#service-management-GETapi-freelancers-services--id-">Get specific service</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="service-management-PUTapi-freelancers-services--id-">
                                <a href="#service-management-PUTapi-freelancers-services--id-">Update service</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="service-management-DELETEapi-freelancers-services--id-">
                                <a href="#service-management-DELETEapi-freelancers-services--id-">Delete service</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-skills" class="tocify-header">
                <li class="tocify-item level-1" data-unique="skills">
                    <a href="#skills">Skills</a>
                </li>
                                    <ul id="tocify-subheader-skills" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="skills-GETapi-skills">
                                <a href="#skills-GETapi-skills">Get all skills</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-user-authentication" class="tocify-header">
                <li class="tocify-item level-1" data-unique="user-authentication">
                    <a href="#user-authentication">User Authentication</a>
                </li>
                                    <ul id="tocify-subheader-user-authentication" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="user-authentication-POSTapi-auth-register">
                                <a href="#user-authentication-POSTapi-auth-register">User Registration.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="user-authentication-POSTapi-auth-resend-code">
                                <a href="#user-authentication-POSTapi-auth-resend-code">Resend Verification Code.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="user-authentication-POSTapi-auth-verify-email">
                                <a href="#user-authentication-POSTapi-auth-verify-email">Verify Email and Complete Registration.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="user-authentication-POSTapi-auth-reset-email">
                                <a href="#user-authentication-POSTapi-auth-reset-email">Reset Email Address.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="user-authentication-POSTapi-auth-login">
                                <a href="#user-authentication-POSTapi-auth-login">Login.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="user-authentication-POSTapi-auth-forget-password">
                                <a href="#user-authentication-POSTapi-auth-forget-password">Forget Password - Send Reset Code.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="user-authentication-POSTapi-auth-reset-password">
                                <a href="#user-authentication-POSTapi-auth-reset-password">Reset Password.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="user-authentication-POSTapi-auth-change-password">
                                <a href="#user-authentication-POSTapi-auth-change-password">Change User Password.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="user-authentication-POSTapi-auth-change-email">
                                <a href="#user-authentication-POSTapi-auth-change-email">Change Email Address.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="user-authentication-POSTapi-auth-verify-change-email">
                                <a href="#user-authentication-POSTapi-auth-verify-change-email">Verify Email Change.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="user-authentication-GETapi-auth-profile">
                                <a href="#user-authentication-GETapi-auth-profile">Get User Profile.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="user-authentication-POSTapi-auth-profile">
                                <a href="#user-authentication-POSTapi-auth-profile">Update User Profile.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="user-authentication-POSTapi-auth-logout">
                                <a href="#user-authentication-POSTapi-auth-logout">User Logout.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="user-authentication-POSTapi-auth-refresh">
                                <a href="#user-authentication-POSTapi-auth-refresh">Refresh Token.</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-user-verification" class="tocify-header">
                <li class="tocify-item level-1" data-unique="user-verification">
                    <a href="#user-verification">User Verification</a>
                </li>
                                    <ul id="tocify-subheader-user-verification" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="user-verification-POSTapi-verifications">
                                <a href="#user-verification-POSTapi-verifications">Submit User Verification Request</a>
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
        <li>Last updated: October 7, 2025</li>
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

        <h1 id="admin-authentication">Admin Authentication</h1>

    <p>APIs for admin authentication and authorization.
These endpoints handle admin login and session management.</p>

                                <h2 id="admin-authentication-POSTapi-admin-auth-login">Admin Login.</h2>

<p>
</p>

<p>This endpoint authenticates administrators and returns a JWT token along with admin permissions.
Only users with admin privileges can access this endpoint.</p>

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
            <p>Example response (200, Login successful):</p>
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
                    &quot;freelancer.viewAny&quot;,
                    &quot;freelancer.view&quot;,
                    &quot;freelancer.create&quot;,
                    &quot;freelancer.delete&quot;,
                    &quot;freelancer.approveAndReject&quot;
                ],
                &quot;role&quot;: &quot;super-admin&quot;
            },
            &quot;created_at&quot;: &quot;2025-08-21T07:43:34.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-08-21T07:43:34.000000Z&quot;
        },
        &quot;token&quot;: &quot;eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Invalid password):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;Invalid password&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, Invalid email):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 404,
    &quot;message&quot;: &quot;The selected email is invalid.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Validation error):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The email field is required.&quot;
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
<p>Admin email address. Example: <code>admin@admin.com</code></p>
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
<p>Admin password. Example: <code>password123</code></p>
        </div>
        </form>

                <h1 id="admin-category-management">Admin Category Management</h1>

    <p>APIs for managing categories in the admin panel.
These endpoints allow administrators to view, create, update, and delete categories,
including bulk creation with children and searching/filtering.</p>

                                <h2 id="admin-category-management-GETapi-admin-categories">List categories with optional filters and pagination.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>This endpoint returns a paginated list of categories. You can filter by type and search by name.</p>

<span id="example-requests-GETapi-admin-categories">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://backend.shuwier.com/api/admin/categories?search=%D8%AA%D8%B5%D9%85%D9%8A%D9%85&amp;per_page=20&amp;type=parent.+Possible+values%3A+parent%2C+child&amp;parent_id=2&amp;page=2" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/admin/categories"
);

const params = {
    "search": "تصميم",
    "per_page": "20",
    "type": "parent. Possible values: parent, child",
    "parent_id": "2",
    "page": "2",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-admin-categories">
            <blockquote>
            <p>Example response (200, Categories retrieved successfully):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Success&quot;,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;name_en&quot;: &quot;Design&quot;,
            &quot;name_ar&quot;: &quot;تصميم&quot;,
            &quot;parent_id&quot;: null,
            &quot;created_at&quot;: &quot;2025-09-07T10:30:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-07T10:30:00.000000Z&quot;
        }
    ],
    &quot;current_page&quot;: 1,
    &quot;last_page&quot;: 3,
    &quot;per_page&quot;: 10,
    &quot;total&quot;: 25
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-categories" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-categories"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-categories"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-categories" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-categories">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-categories" data-method="GET"
      data-path="api/admin/categories"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-categories', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-categories"
                    onclick="tryItOut('GETapi-admin-categories');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-categories"
                    onclick="cancelTryOut('GETapi-admin-categories');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-categories"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/categories</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-categories"
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
                              name="Accept"                data-endpoint="GETapi-admin-categories"
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
                              name="Accept-Language"                data-endpoint="GETapi-admin-categories"
               value="en"
               data-component="header">
    <br>
<p>Example: <code>en</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>search</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="search"                data-endpoint="GETapi-admin-categories"
               value="تصميم"
               data-component="query">
    <br>
<p>Optional search by category name (Arabic or English). Example: <code>تصميم</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-admin-categories"
               value="20"
               data-component="query">
    <br>
<p>Number of items per page (default: 10). Example: <code>20</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="type"                data-endpoint="GETapi-admin-categories"
               value="parent. Possible values: parent, child"
               data-component="query">
    <br>
<p>Optional filter by category type. Example: <code>parent. Possible values: parent, child</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>parent_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="parent_id"                data-endpoint="GETapi-admin-categories"
               value="2"
               data-component="query">
    <br>
<p>The parent category ID to filter by (only used when type is 'child'). Example: <code>2</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="page"                data-endpoint="GETapi-admin-categories"
               value="2"
               data-component="query">
    <br>
<p>Page number for pagination (default: 1). Example: <code>2</code></p>
            </div>
                </form>

                    <h2 id="admin-category-management-POSTapi-admin-categories">Create a new category.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>This endpoint allows admins to create a new category. You can specify parent_id to create a subcategory.</p>

<span id="example-requests-POSTapi-admin-categories">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://backend.shuwier.com/api/admin/categories" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --header "Accept-Language: en" \
    --form "name_en=Design"\
    --form "name_ar=تصميم"\
    --form "parent_id=2"\
    --form "image=@/private/var/folders/bh/ymm81xv929z74_28m5_265d40000gn/T/phpdAwpEV" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/admin/categories"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
    "Accept-Language": "en",
};

const body = new FormData();
body.append('name_en', 'Design');
body.append('name_ar', 'تصميم');
body.append('parent_id', '2');
body.append('image', document.querySelector('input[name="image"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-admin-categories">
            <blockquote>
            <p>Example response (201, Category created successfully):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Category created successfully&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 5,
        &quot;name_en&quot;: &quot;Development&quot;,
        &quot;name_ar&quot;: &quot;تطوير&quot;,
        &quot;image&quot;: &quot;development.jpg&quot;,
        &quot;parent_id&quot;: null,
        &quot;created_at&quot;: &quot;2025-09-07T10:30:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-07T10:30:00.000000Z&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Validation error):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The name_en field is required.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-admin-categories" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-admin-categories"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-admin-categories"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-admin-categories" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-admin-categories">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-admin-categories" data-method="POST"
      data-path="api/admin/categories"
      data-authed="1"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-admin-categories', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-admin-categories"
                    onclick="tryItOut('POSTapi-admin-categories');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-admin-categories"
                    onclick="cancelTryOut('POSTapi-admin-categories');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-admin-categories"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/admin/categories</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-admin-categories"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-admin-categories"
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
                              name="Accept-Language"                data-endpoint="POSTapi-admin-categories"
               value="en"
               data-component="header">
    <br>
<p>Example: <code>en</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name_en</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name_en"                data-endpoint="POSTapi-admin-categories"
               value="Design"
               data-component="body">
    <br>
<p>Category name in English. Example: <code>Design</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name_ar</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name_ar"                data-endpoint="POSTapi-admin-categories"
               value="تصميم"
               data-component="body">
    <br>
<p>Category name in Arabic. Example: <code>تصميم</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>parent_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="parent_id"                data-endpoint="POSTapi-admin-categories"
               value="2"
               data-component="body">
    <br>
<p>The parent category ID (for subcategories). Example: <code>2</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>image</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="image"                data-endpoint="POSTapi-admin-categories"
               value=""
               data-component="body">
    <br>
<p>Category image file (required for parent categories). Example: <code>/private/var/folders/bh/ymm81xv929z74_28m5_265d40000gn/T/phpdAwpEV</code></p>
        </div>
        </form>

                    <h2 id="admin-category-management-GETapi-admin-categories--id-">Show category details by ID.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>This endpoint returns details for a specific category by its ID.</p>

<span id="example-requests-GETapi-admin-categories--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://backend.shuwier.com/api/admin/categories/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/admin/categories/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-admin-categories--id-">
            <blockquote>
            <p>Example response (200, Category details retrieved successfully):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Success&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;name_en&quot;: &quot;Design&quot;,
        &quot;name_ar&quot;: &quot;تصميم&quot;,
        &quot;image&quot;: null,
        &quot;parent_id&quot;: null,
        &quot;created_at&quot;: &quot;2025-09-07T10:30:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-07T10:30:00.000000Z&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, Category not found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 404,
    &quot;message&quot;: &quot;Category not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-categories--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-categories--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-categories--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-categories--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-categories--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-categories--id-" data-method="GET"
      data-path="api/admin/categories/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-categories--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-categories--id-"
                    onclick="tryItOut('GETapi-admin-categories--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-categories--id-"
                    onclick="cancelTryOut('GETapi-admin-categories--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-categories--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/categories/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-categories--id-"
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
                              name="Accept"                data-endpoint="GETapi-admin-categories--id-"
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
                              name="Accept-Language"                data-endpoint="GETapi-admin-categories--id-"
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
               step="any"               name="id"                data-endpoint="GETapi-admin-categories--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the category to view. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="admin-category-management-PUTapi-admin-categories--id-">Update a category by ID.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>This endpoint allows admins to update the name of a category (English/Arabic).</p>

<span id="example-requests-PUTapi-admin-categories--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://backend.shuwier.com/api/admin/categories/1" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --header "Accept-Language: en" \
    --form "name_en=Design"\
    --form "name_ar=تصميم"\
    --form "parent_id=2"\
    --form "image=@/private/var/folders/bh/ymm81xv929z74_28m5_265d40000gn/T/phpN7nOZU" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/admin/categories/1"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
    "Accept-Language": "en",
};

const body = new FormData();
body.append('name_en', 'Design');
body.append('name_ar', 'تصميم');
body.append('parent_id', '2');
body.append('image', document.querySelector('input[name="image"]').files[0]);

fetch(url, {
    method: "PUT",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-admin-categories--id-">
            <blockquote>
            <p>Example response (200, Category updated successfully):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
  &quot;status&quot;: true,
  &quot;error_num&quot;: null,
  &quot;message&quot;: &quot;Category updated successfully&quot;,
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Validation error):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The name_en field is required.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, Category not found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 404,
    &quot;message&quot;: &quot;Category not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-admin-categories--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-admin-categories--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-admin-categories--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-admin-categories--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-admin-categories--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-admin-categories--id-" data-method="PUT"
      data-path="api/admin/categories/{id}"
      data-authed="1"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-admin-categories--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-admin-categories--id-"
                    onclick="tryItOut('PUTapi-admin-categories--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-admin-categories--id-"
                    onclick="cancelTryOut('PUTapi-admin-categories--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-admin-categories--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/admin/categories/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/admin/categories/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-admin-categories--id-"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-admin-categories--id-"
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
                              name="Accept-Language"                data-endpoint="PUTapi-admin-categories--id-"
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
               step="any"               name="id"                data-endpoint="PUTapi-admin-categories--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the category to update. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name_en</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="name_en"                data-endpoint="PUTapi-admin-categories--id-"
               value="Design"
               data-component="body">
    <br>
<p>Category name in English. Example: <code>Design</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name_ar</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="name_ar"                data-endpoint="PUTapi-admin-categories--id-"
               value="تصميم"
               data-component="body">
    <br>
<p>Category name in Arabic. Example: <code>تصميم</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>parent_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="parent_id"                data-endpoint="PUTapi-admin-categories--id-"
               value="2"
               data-component="body">
    <br>
<p>The parent category ID (for subcategories). Example: <code>2</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>image</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="file" style="display: none"
                              name="image"                data-endpoint="PUTapi-admin-categories--id-"
               value=""
               data-component="body">
    <br>
<p>Optional category image file. If not provided, the existing image will remain unchanged. Send a new image file to update it. Example: <code>/private/var/folders/bh/ymm81xv929z74_28m5_265d40000gn/T/phpN7nOZU</code></p>
        </div>
        </form>

                    <h2 id="admin-category-management-DELETEapi-admin-categories--id-">Delete a category by ID.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>This endpoint allows admins to delete a category by its ID.</p>

<span id="example-requests-DELETEapi-admin-categories--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://backend.shuwier.com/api/admin/categories/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/admin/categories/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-admin-categories--id-">
            <blockquote>
            <p>Example response (200, Category deleted successfully):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Category deleted successfully&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, Category not found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 404,
    &quot;message&quot;: &quot;Category not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-admin-categories--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-admin-categories--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-admin-categories--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-admin-categories--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-admin-categories--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-admin-categories--id-" data-method="DELETE"
      data-path="api/admin/categories/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-admin-categories--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-admin-categories--id-"
                    onclick="tryItOut('DELETEapi-admin-categories--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-admin-categories--id-"
                    onclick="cancelTryOut('DELETEapi-admin-categories--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-admin-categories--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/admin/categories/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-admin-categories--id-"
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
                              name="Accept"                data-endpoint="DELETEapi-admin-categories--id-"
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
                              name="Accept-Language"                data-endpoint="DELETEapi-admin-categories--id-"
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
               step="any"               name="id"                data-endpoint="DELETEapi-admin-categories--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the category to delete. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="admin-category-management-POSTapi-admin-categories-store-all-with-childrens">Bulk create categories with children.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>This endpoint allows admins to create a category and its children in one request.
Useful for importing category trees.</p>

<span id="example-requests-POSTapi-admin-categories-store-all-with-childrens">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://backend.shuwier.com/api/admin/categories/store-all-with-childrens" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en" \
    --data "{
    \"name_en\": \"Programming\",
    \"name_ar\": \"برمجة\",
    \"childrens\": [
        {
            \"name_en\": \"Web\",
            \"name_ar\": \"ويب\"
        }
    ]
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/admin/categories/store-all-with-childrens"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

let body = {
    "name_en": "Programming",
    "name_ar": "برمجة",
    "childrens": [
        {
            "name_en": "Web",
            "name_ar": "ويب"
        }
    ]
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-admin-categories-store-all-with-childrens">
            <blockquote>
            <p>Example response (201, Categories created successfully):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Categories created successfully&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Validation error):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The childrens field must be an array.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-admin-categories-store-all-with-childrens" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-admin-categories-store-all-with-childrens"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-admin-categories-store-all-with-childrens"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-admin-categories-store-all-with-childrens" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-admin-categories-store-all-with-childrens">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-admin-categories-store-all-with-childrens" data-method="POST"
      data-path="api/admin/categories/store-all-with-childrens"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-admin-categories-store-all-with-childrens', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-admin-categories-store-all-with-childrens"
                    onclick="tryItOut('POSTapi-admin-categories-store-all-with-childrens');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-admin-categories-store-all-with-childrens"
                    onclick="cancelTryOut('POSTapi-admin-categories-store-all-with-childrens');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-admin-categories-store-all-with-childrens"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/admin/categories/store-all-with-childrens</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-admin-categories-store-all-with-childrens"
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
                              name="Accept"                data-endpoint="POSTapi-admin-categories-store-all-with-childrens"
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
                              name="Accept-Language"                data-endpoint="POSTapi-admin-categories-store-all-with-childrens"
               value="en"
               data-component="header">
    <br>
<p>Example: <code>en</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name_en</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name_en"                data-endpoint="POSTapi-admin-categories-store-all-with-childrens"
               value="Programming"
               data-component="body">
    <br>
<p>Parent category name in English. Example: <code>Programming</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name_ar</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name_ar"                data-endpoint="POSTapi-admin-categories-store-all-with-childrens"
               value="برمجة"
               data-component="body">
    <br>
<p>Parent category name in Arabic. Example: <code>برمجة</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>childrens</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
<i>optional</i> &nbsp;
<br>
<p>Array of child categories (each with name_en, name_ar).</p>
            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>name_en</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="childrens.0.name_en"                data-endpoint="POSTapi-admin-categories-store-all-with-childrens"
               value="Web Development"
               data-component="body">
    <br>
<p>Child category name in English (required if childrens array is provided). Must not be greater than 255 characters. Example: <code>Web Development</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>name_ar</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="childrens.0.name_ar"                data-endpoint="POSTapi-admin-categories-store-all-with-childrens"
               value="تطوير المواقع"
               data-component="body">
    <br>
<p>Child category name in Arabic (required if childrens array is provided). Must not be greater than 255 characters. Example: <code>تطوير المواقع</code></p>
                    </div>
                                    </details>
        </div>
        </form>

                <h1 id="admin-client-management">Admin Client Management</h1>

    <p>APIs for managing clients in the admin panel.
These endpoints allow administrators to view and manage client accounts,
including listing all clients and viewing individual client details.</p>

                                <h2 id="admin-client-management-GETapi-admin-clients">Display a listing of clients with optional filters.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>This endpoint returns a paginated list of all clients in the system.
Results can be filtered by client name for easy searching.
The response includes pagination metadata for easy navigation.</p>

<span id="example-requests-GETapi-admin-clients">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://backend.shuwier.com/api/admin/clients?name=%D8%B3%D8%A7%D8%B1%D8%A9&amp;page=2" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en" \
    --data "{
    \"name\": \"vmqeopfuudtdsufvyvddq\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/admin/clients"
);

const params = {
    "name": "سارة",
    "page": "2",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

let body = {
    "name": "vmqeopfuudtdsufvyvddq"
};

fetch(url, {
    method: "GET",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-admin-clients">
            <blockquote>
            <p>Example response (200, Clients retrieved successfully):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Clients retrieved successfully&quot;,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;سارة&quot;,
            &quot;email&quot;: &quot;sara@example.com&quot;,
            &quot;email_verified_at&quot;: &quot;2025-08-24T10:30:00.000000Z&quot;,
            &quot;phone&quot;: &quot;+201234567890&quot;,
            &quot;type&quot;: &quot;client&quot;,
            &quot;is_active&quot;: true,
            &quot;about_me&quot;: &quot;مديرة مشاريع تقنية&quot;,
            &quot;profile_picture&quot;: null,
            &quot;company&quot;: &quot;شركة التقنيات المتقدمة&quot;,
            &quot;created_at&quot;: &quot;2025-08-24T10:30:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-08-24T10:30:00.000000Z&quot;
        },
        {
            &quot;id&quot;: 2,
            &quot;name&quot;: &quot;محمد&quot;,
            &quot;email&quot;: &quot;mohamed@example.com&quot;,
            &quot;email_verified_at&quot;: &quot;2025-08-25T10:30:00.000000Z&quot;,
            &quot;phone&quot;: &quot;+201987654321&quot;,
            &quot;type&quot;: &quot;client&quot;,
            &quot;is_active&quot;: true,
            &quot;about_me&quot;: null,
            &quot;profile_picture&quot;: null,
            &quot;company&quot;: null,
            &quot;created_at&quot;: &quot;2025-08-25T10:30:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-08-25T10:30:00.000000Z&quot;
        }
    ],
    &quot;current_page&quot;: 1,
    &quot;from&quot;: 1,
    &quot;last_page&quot;: 3,
    &quot;per_page&quot;: 10,
    &quot;to&quot;: 10,
    &quot;total&quot;: 25,
    &quot;links&quot;: {
        &quot;first&quot;: &quot;http://localhost/api/admin/clients?page=1&quot;,
        &quot;last&quot;: &quot;http://localhost/api/admin/clients?page=3&quot;,
        &quot;prev&quot;: null,
        &quot;next&quot;: &quot;http://localhost/api/admin/clients?page=2&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Validation error):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The name field must be a string.&quot;
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
<span id="execution-results-GETapi-admin-clients" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-clients"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-clients"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-clients" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-clients">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-clients" data-method="GET"
      data-path="api/admin/clients"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-clients', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-clients"
                    onclick="tryItOut('GETapi-admin-clients');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-clients"
                    onclick="cancelTryOut('GETapi-admin-clients');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-clients"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/clients</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-clients"
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
                              name="Accept"                data-endpoint="GETapi-admin-clients"
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
                              name="Accept-Language"                data-endpoint="GETapi-admin-clients"
               value="en"
               data-component="header">
    <br>
<p>Example: <code>en</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="GETapi-admin-clients"
               value="سارة"
               data-component="query">
    <br>
<p>Optional filter by client name (searches in name). Example: <code>سارة</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="page"                data-endpoint="GETapi-admin-clients"
               value="2"
               data-component="query">
    <br>
<p>Optional page number for pagination (default: 1). Example: <code>2</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="GETapi-admin-clients"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
        </form>

                    <h2 id="admin-client-management-GETapi-admin-clients--id-">Display the specified client details.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>This endpoint returns detailed information about a specific client account.
Includes all client profile information and account status.</p>

<span id="example-requests-GETapi-admin-clients--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://backend.shuwier.com/api/admin/clients/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/admin/clients/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-admin-clients--id-">
            <blockquote>
            <p>Example response (200, Client details retrieved successfully):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Client retrieved successfully&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;سارة أحمد&quot;,
        &quot;email&quot;: &quot;sara@example.com&quot;,
        &quot;email_verified_at&quot;: &quot;2025-08-24T10:30:00.000000Z&quot;,
        &quot;phone&quot;: &quot;+201234567890&quot;,
        &quot;type&quot;: &quot;client&quot;,
        &quot;is_active&quot;: true,
        &quot;about_me&quot;: &quot;مديرة مشاريع تقنية مع خبرة 5 سنوات في إدارة فرق التطوير&quot;,
        &quot;profile_picture&quot;: &quot;https://example.com/storage/profiles/sara.jpg&quot;,
        &quot;company&quot;: &quot;شركة التقنيات المتقدمة&quot;,
        &quot;created_at&quot;: &quot;2025-08-24T10:30:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-02T10:30:00.000000Z&quot;
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
    &quot;message&quot;: &quot;Client not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-clients--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-clients--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-clients--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-clients--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-clients--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-clients--id-" data-method="GET"
      data-path="api/admin/clients/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-clients--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-clients--id-"
                    onclick="tryItOut('GETapi-admin-clients--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-clients--id-"
                    onclick="cancelTryOut('GETapi-admin-clients--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-clients--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/clients/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-clients--id-"
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
                              name="Accept"                data-endpoint="GETapi-admin-clients--id-"
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
                              name="Accept-Language"                data-endpoint="GETapi-admin-clients--id-"
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
               step="any"               name="id"                data-endpoint="GETapi-admin-clients--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the client to view. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="admin-client-management-DELETEapi-admin-clients--id-">Delete a client account permanently.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>This endpoint allows admins to permanently delete a client account from the system.
This action cannot be undone and will remove all associated data including profile information
and any project history. Use with caution as this is a destructive operation.</p>

<span id="example-requests-DELETEapi-admin-clients--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://backend.shuwier.com/api/admin/clients/5" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/admin/clients/5"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-admin-clients--id-">
            <blockquote>
            <p>Example response (200, Client deleted successfully):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Client deleted successfully&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Client has active projects):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;Cannot delete client with active projects&quot;
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
    &quot;message&quot;: &quot;Client not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-admin-clients--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-admin-clients--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-admin-clients--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-admin-clients--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-admin-clients--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-admin-clients--id-" data-method="DELETE"
      data-path="api/admin/clients/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-admin-clients--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-admin-clients--id-"
                    onclick="tryItOut('DELETEapi-admin-clients--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-admin-clients--id-"
                    onclick="cancelTryOut('DELETEapi-admin-clients--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-admin-clients--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/admin/clients/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-admin-clients--id-"
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
                              name="Accept"                data-endpoint="DELETEapi-admin-clients--id-"
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
                              name="Accept-Language"                data-endpoint="DELETEapi-admin-clients--id-"
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
               step="any"               name="id"                data-endpoint="DELETEapi-admin-clients--id-"
               value="5"
               data-component="url">
    <br>
<p>The ID of the client to delete. Example: <code>5</code></p>
            </div>
                    </form>

                    <h2 id="admin-client-management-POSTapi-admin-clients-block-unblock--id-">Block or Unblock a client account.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>This endpoint allows admins to toggle the active status of a client account.
When blocked (is_active = false), the client cannot log in or access the platform.
When unblocked (is_active = true), the client can resume normal platform activities.
This is a reversible action unlike deletion.</p>

<span id="example-requests-POSTapi-admin-clients-block-unblock--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://backend.shuwier.com/api/admin/clients/block-unblock/3" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/admin/clients/block-unblock/3"
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

<span id="example-responses-POSTapi-admin-clients-block-unblock--id-">
            <blockquote>
            <p>Example response (200, Client blocked successfully):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Client blocked successfully&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (200, Client unblocked successfully):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Client unblocked successfully&quot;
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
    &quot;message&quot;: &quot;Client not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-admin-clients-block-unblock--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-admin-clients-block-unblock--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-admin-clients-block-unblock--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-admin-clients-block-unblock--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-admin-clients-block-unblock--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-admin-clients-block-unblock--id-" data-method="POST"
      data-path="api/admin/clients/block-unblock/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-admin-clients-block-unblock--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-admin-clients-block-unblock--id-"
                    onclick="tryItOut('POSTapi-admin-clients-block-unblock--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-admin-clients-block-unblock--id-"
                    onclick="cancelTryOut('POSTapi-admin-clients-block-unblock--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-admin-clients-block-unblock--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/admin/clients/block-unblock/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-admin-clients-block-unblock--id-"
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
                              name="Accept"                data-endpoint="POSTapi-admin-clients-block-unblock--id-"
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
                              name="Accept-Language"                data-endpoint="POSTapi-admin-clients-block-unblock--id-"
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
               step="any"               name="id"                data-endpoint="POSTapi-admin-clients-block-unblock--id-"
               value="3"
               data-component="url">
    <br>
<p>The ID of the client to block/unblock. Example: <code>3</code></p>
            </div>
                    </form>

                <h1 id="admin-commission-management">Admin Commission Management</h1>

    

                                <h2 id="admin-commission-management-GETapi-admin-commissions">List commissions</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retrieve a paginated list of all commission rates in the system. This endpoint allows
admins to view and search through commission rates with optional filtering by search terms.
Results are ordered by creation date (newest first).</p>

<span id="example-requests-GETapi-admin-commissions">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://backend.shuwier.com/api/admin/commissions?search=15&amp;per_page=15" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en" \
    --data "{
    \"search\": \"consequatur\",
    \"per_page\": 13
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/admin/commissions"
);

const params = {
    "search": "15",
    "per_page": "15",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

let body = {
    "search": "consequatur",
    "per_page": 13
};

fetch(url, {
    method: "GET",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-admin-commissions">
            <blockquote>
            <p>Example response (200, Commissions retrieved successfully):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Success&quot;,
    &quot;data&quot;: {
        &quot;current_page&quot;: 1,
        &quot;data&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;rate&quot;: 0.15,
                &quot;effective_from&quot;: &quot;2025-10-01&quot;,
                &quot;created_by&quot;: 1,
                &quot;created_at&quot;: &quot;2025-09-28T10:00:00.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-28T10:00:00.000000Z&quot;
            },
            {
                &quot;id&quot;: 2,
                &quot;rate&quot;: 0.12,
                &quot;effective_from&quot;: &quot;2025-11-01&quot;,
                &quot;created_by&quot;: 1,
                &quot;created_at&quot;: &quot;2025-09-27T15:30:00.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-27T15:30:00.000000Z&quot;
            }
        ],
        &quot;first_page_url&quot;: &quot;http://localhost/api/admin/commissions?page=1&quot;,
        &quot;from&quot;: 1,
        &quot;last_page&quot;: 1,
        &quot;last_page_url&quot;: &quot;http://localhost/api/admin/commissions?page=1&quot;,
        &quot;links&quot;: [
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost/api/admin/commissions?page=1&quot;,
                &quot;label&quot;: &quot;1&quot;,
                &quot;active&quot;: true
            },
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
                &quot;active&quot;: false
            }
        ],
        &quot;next_page_url&quot;: null,
        &quot;path&quot;: &quot;http://localhost/api/admin/commissions&quot;,
        &quot;per_page&quot;: 10,
        &quot;prev_page_url&quot;: null,
        &quot;to&quot;: 2,
        &quot;total&quot;: 2
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Invalid parameters):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The per page field must be at least 1.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, Unauthenticated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 401,
    &quot;message&quot;: &quot;Unauthenticated&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-commissions" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-commissions"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-commissions"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-commissions" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-commissions">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-commissions" data-method="GET"
      data-path="api/admin/commissions"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-commissions', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-commissions"
                    onclick="tryItOut('GETapi-admin-commissions');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-commissions"
                    onclick="cancelTryOut('GETapi-admin-commissions');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-commissions"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/commissions</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-commissions"
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
                              name="Accept"                data-endpoint="GETapi-admin-commissions"
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
                              name="Accept-Language"                data-endpoint="GETapi-admin-commissions"
               value="en"
               data-component="header">
    <br>
<p>Example: <code>en</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>search</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="search"                data-endpoint="GETapi-admin-commissions"
               value="15"
               data-component="query">
    <br>
<p>optional Search term to filter commissions by rate or effective date. Example: <code>15</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-admin-commissions"
               value="15"
               data-component="query">
    <br>
<p>optional Number of items per page (1-100). Example: <code>15</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>search</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="search"                data-endpoint="GETapi-admin-commissions"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-admin-commissions"
               value="13"
               data-component="body">
    <br>
<p>Must be at least 1. Must not be greater than 100. Example: <code>13</code></p>
        </div>
        </form>

                    <h2 id="admin-commission-management-POSTapi-admin-commissions">Create commission</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Create a new commission rate that will be effective from a specified future date.
The commission rate is stored as a decimal (e.g., 15% is stored as 0.15) and must
be between 1% and 100%. The effective date must be today or in the future.</p>

<span id="example-requests-POSTapi-admin-commissions">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://backend.shuwier.com/api/admin/commissions" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en" \
    --data "{
    \"rate\": 15
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/admin/commissions"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

let body = {
    "rate": 15
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-admin-commissions">
            <blockquote>
            <p>Example response (200, Commission created successfully):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Commission created successfully&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 3,
        &quot;rate&quot;: 0.15,
        &quot;effective_from&quot;: &quot;2025-10-01&quot;,
        &quot;created_by&quot;: 1,
        &quot;created_at&quot;: &quot;2025-09-28T12:00:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-28T12:00:00.000000Z&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Invalid rate):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The rate field must be between 1 and 100.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Invalid effective date):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The effective from field must be a date after or equal to today.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Validation error):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The rate field is required.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, Unauthenticated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 401,
    &quot;message&quot;: &quot;Unauthenticated&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-admin-commissions" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-admin-commissions"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-admin-commissions"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-admin-commissions" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-admin-commissions">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-admin-commissions" data-method="POST"
      data-path="api/admin/commissions"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-admin-commissions', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-admin-commissions"
                    onclick="tryItOut('POSTapi-admin-commissions');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-admin-commissions"
                    onclick="cancelTryOut('POSTapi-admin-commissions');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-admin-commissions"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/admin/commissions</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-admin-commissions"
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
                              name="Accept"                data-endpoint="POSTapi-admin-commissions"
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
                              name="Accept-Language"                data-endpoint="POSTapi-admin-commissions"
               value="en"
               data-component="header">
    <br>
<p>Example: <code>en</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>rate</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="rate"                data-endpoint="POSTapi-admin-commissions"
               value="15"
               data-component="body">
    <br>
<p>Commission rate percentage (1-100). Will be converted to decimal for storage. Example: <code>15</code></p>
        </div>
        </form>

                <h1 id="admin-freelancer-invitations">Admin Freelancer Invitations</h1>

    

                                <h2 id="admin-freelancer-invitations-GETapi-admin-invitations">Get All Freelancer Invitations</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retrieve a paginated list of all freelancer invitations sent by the admin.</p>

<span id="example-requests-GETapi-admin-invitations">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://backend.shuwier.com/api/admin/invitations?per_page=15" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en" \
    --data "{
    \"per_page\": 73
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/admin/invitations"
);

const params = {
    "per_page": "15",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

let body = {
    "per_page": 73
};

fetch(url, {
    method: "GET",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-admin-invitations">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Success&quot;,
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;data&quot;: {
        &quot;current_page&quot;: 1,
        &quot;data&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;email&quot;: &quot;freelancer@example.com&quot;,
                &quot;expired_at&quot;: &quot;2025-09-23T10:00:00.000000Z&quot;,
                &quot;created_at&quot;: &quot;2025-09-16T10:00:00.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-16T10:00:00.000000Z&quot;
            }
        ],
        &quot;per_page&quot;: 10,
        &quot;total&quot;: 1
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Validation error&quot;,
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-invitations" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-invitations"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-invitations"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-invitations" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-invitations">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-invitations" data-method="GET"
      data-path="api/admin/invitations"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-invitations', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-invitations"
                    onclick="tryItOut('GETapi-admin-invitations');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-invitations"
                    onclick="cancelTryOut('GETapi-admin-invitations');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-invitations"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/invitations</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-invitations"
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
                              name="Accept"                data-endpoint="GETapi-admin-invitations"
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
                              name="Accept-Language"                data-endpoint="GETapi-admin-invitations"
               value="en"
               data-component="header">
    <br>
<p>Example: <code>en</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-admin-invitations"
               value="15"
               data-component="query">
    <br>
<p>optional Number of items per page. Minimum: 1. Example: <code>15</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-admin-invitations"
               value="73"
               data-component="body">
    <br>
<p>Must be at least 1. Example: <code>73</code></p>
        </div>
        </form>

                    <h2 id="admin-freelancer-invitations-POSTapi-admin-invitations">Send Freelancer Invitation</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Send an invitation email to a potential freelancer. The email must be unique and not already registered.</p>

<span id="example-requests-POSTapi-admin-invitations">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://backend.shuwier.com/api/admin/invitations" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en" \
    --data "{
    \"email\": \"freelancer@example.com\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/admin/invitations"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

let body = {
    "email": "freelancer@example.com"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-admin-invitations">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Invitation sent successfully&quot;,
    &quot;status&quot;: true,
    &quot;error_num&quot;: null
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The email field is required.&quot;,
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The email has already been taken.&quot;,
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;User already registered&quot;,
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-admin-invitations" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-admin-invitations"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-admin-invitations"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-admin-invitations" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-admin-invitations">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-admin-invitations" data-method="POST"
      data-path="api/admin/invitations"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-admin-invitations', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-admin-invitations"
                    onclick="tryItOut('POSTapi-admin-invitations');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-admin-invitations"
                    onclick="cancelTryOut('POSTapi-admin-invitations');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-admin-invitations"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/admin/invitations</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-admin-invitations"
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
                              name="Accept"                data-endpoint="POSTapi-admin-invitations"
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
                              name="Accept-Language"                data-endpoint="POSTapi-admin-invitations"
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
                              name="email"                data-endpoint="POSTapi-admin-invitations"
               value="freelancer@example.com"
               data-component="body">
    <br>
<p>A valid email address for the freelancer invitation. Must be unique and not already registered. Example: <code>freelancer@example.com</code></p>
        </div>
        </form>

                <h1 id="admin-freelancer-management">Admin Freelancer Management</h1>

    <p>APIs for managing freelancers in the admin panel.
These endpoints allow administrators to view, create, delete, and manage freelancer accounts,
including approving or rejecting freelancer applications.</p>

                                <h2 id="admin-freelancer-management-GETapi-admin-freelancers">Display a listing of freelancers with optional filters.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>This endpoint returns a paginated list of all freelancers in the system.
Results can be filtered by approval status, active status, and name.
The response includes pagination metadata for easy navigation.</p>

<span id="example-requests-GETapi-admin-freelancers">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://backend.shuwier.com/api/admin/freelancers?approval_status=requested&amp;is_active=1&amp;name=%D8%A3%D8%AD%D9%85%D8%AF&amp;page=2" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en" \
    --data "{
    \"approval_status\": \"approved\",
    \"is_active\": \"1\",
    \"name\": \"vmqeopfuudtdsufvyvddq\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/admin/freelancers"
);

const params = {
    "approval_status": "requested",
    "is_active": "1",
    "name": "أحمد",
    "page": "2",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

let body = {
    "approval_status": "approved",
    "is_active": "1",
    "name": "vmqeopfuudtdsufvyvddq"
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
            &quot;name&quot;: &quot;John Doe&quot;,
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
<p>Optional filter by approval status. Must be &quot;requested&quot; or &quot;approved&quot;. Example: <code>requested</code></p>
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
<p>Optional filter by active status. Must be 0 (inactive) or 1 (active). Example: <code>1</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="GETapi-admin-freelancers"
               value="أحمد"
               data-component="query">
    <br>
<p>Optional filter by freelancer name (searches in name). Example: <code>أحمد</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="page"                data-endpoint="GETapi-admin-freelancers"
               value="2"
               data-component="query">
    <br>
<p>Optional page number for pagination (default: 1). Example: <code>2</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>approval_status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="approval_status"                data-endpoint="GETapi-admin-freelancers"
               value="approved"
               data-component="body">
    <br>
<p>Example: <code>approved</code></p>
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
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="GETapi-admin-freelancers"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
        </form>

                    <h2 id="admin-freelancer-management-GETapi-admin-freelancers--id-">Display the specified freelancer details.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-admin-freelancers--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://backend.shuwier.com/api/admin/freelancers/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/admin/freelancers/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-admin-freelancers--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Success&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;John Doe&quot;,
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
<span id="execution-results-GETapi-admin-freelancers--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-freelancers--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-freelancers--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-freelancers--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-freelancers--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-freelancers--id-" data-method="GET"
      data-path="api/admin/freelancers/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-freelancers--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-freelancers--id-"
                    onclick="tryItOut('GETapi-admin-freelancers--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-freelancers--id-"
                    onclick="cancelTryOut('GETapi-admin-freelancers--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-freelancers--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/freelancers/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-freelancers--id-"
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
                              name="Accept"                data-endpoint="GETapi-admin-freelancers--id-"
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
                              name="Accept-Language"                data-endpoint="GETapi-admin-freelancers--id-"
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
               step="any"               name="id"                data-endpoint="GETapi-admin-freelancers--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the freelancer to view. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="admin-freelancer-management-DELETEapi-admin-freelancers--id-">Delete a freelancer account permanently.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>This endpoint allows admins to permanently delete a freelancer account from the system.
This action cannot be undone and will remove all associated data including profile information.
Use with caution as this is a destructive operation.</p>

<span id="example-requests-DELETEapi-admin-freelancers--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://backend.shuwier.com/api/admin/freelancers/5" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/admin/freelancers/5"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-admin-freelancers--id-">
            <blockquote>
            <p>Example response (200, Freelancer deleted successfully):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Freelancer deleted successfully&quot;
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
<span id="execution-results-DELETEapi-admin-freelancers--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-admin-freelancers--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-admin-freelancers--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-admin-freelancers--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-admin-freelancers--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-admin-freelancers--id-" data-method="DELETE"
      data-path="api/admin/freelancers/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-admin-freelancers--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-admin-freelancers--id-"
                    onclick="tryItOut('DELETEapi-admin-freelancers--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-admin-freelancers--id-"
                    onclick="cancelTryOut('DELETEapi-admin-freelancers--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-admin-freelancers--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/admin/freelancers/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-admin-freelancers--id-"
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
                              name="Accept"                data-endpoint="DELETEapi-admin-freelancers--id-"
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
                              name="Accept-Language"                data-endpoint="DELETEapi-admin-freelancers--id-"
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
               step="any"               name="id"                data-endpoint="DELETEapi-admin-freelancers--id-"
               value="5"
               data-component="url">
    <br>
<p>The ID of the freelancer to delete. Example: <code>5</code></p>
            </div>
                    </form>

                    <h2 id="admin-freelancer-management-POSTapi-admin-freelancers-approve-reject--id-">Approve or Reject a freelancer application.</h2>

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
        &quot;name&quot;: &quot;احمد حسني&quot;,
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

                    <h2 id="admin-freelancer-management-POSTapi-admin-freelancers-block-unblock--id-">Block or Unblock a freelancer account.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>This endpoint allows admins to toggle the active status of a freelancer account.
When blocked (is_active = false), the freelancer cannot log in or access the platform.
When unblocked (is_active = true), the freelancer can resume normal platform activities.
This is a reversible action unlike deletion.</p>

<span id="example-requests-POSTapi-admin-freelancers-block-unblock--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://backend.shuwier.com/api/admin/freelancers/block-unblock/3" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/admin/freelancers/block-unblock/3"
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

<span id="example-responses-POSTapi-admin-freelancers-block-unblock--id-">
            <blockquote>
            <p>Example response (200, Freelancer blocked successfully):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Freelancer blocked successfully&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (200, Freelancer unblocked successfully):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Freelancer unblocked successfully&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Freelancer not approved yet):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;Cannot block/unblock unapproved freelancer&quot;
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
<span id="execution-results-POSTapi-admin-freelancers-block-unblock--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-admin-freelancers-block-unblock--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-admin-freelancers-block-unblock--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-admin-freelancers-block-unblock--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-admin-freelancers-block-unblock--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-admin-freelancers-block-unblock--id-" data-method="POST"
      data-path="api/admin/freelancers/block-unblock/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-admin-freelancers-block-unblock--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-admin-freelancers-block-unblock--id-"
                    onclick="tryItOut('POSTapi-admin-freelancers-block-unblock--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-admin-freelancers-block-unblock--id-"
                    onclick="cancelTryOut('POSTapi-admin-freelancers-block-unblock--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-admin-freelancers-block-unblock--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/admin/freelancers/block-unblock/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-admin-freelancers-block-unblock--id-"
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
                              name="Accept"                data-endpoint="POSTapi-admin-freelancers-block-unblock--id-"
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
                              name="Accept-Language"                data-endpoint="POSTapi-admin-freelancers-block-unblock--id-"
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
               step="any"               name="id"                data-endpoint="POSTapi-admin-freelancers-block-unblock--id-"
               value="3"
               data-component="url">
    <br>
<p>The ID of the freelancer to block/unblock. Example: <code>3</code></p>
            </div>
                    </form>

                <h1 id="admin-skills-management">Admin Skills Management</h1>

    <p>APIs for managing skills in the system. Skills are used to categorize freelancer capabilities
and can be associated with categories for better organization.</p>

                                <h2 id="admin-skills-management-GETapi-admin-skills">Get All Skills</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retrieve a paginated list of all skills in the system.
This endpoint supports search functionality and pagination.</p>

<span id="example-requests-GETapi-admin-skills">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://backend.shuwier.com/api/admin/skills?search=%22PHP%22&amp;per_page=15" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en" \
    --data "{
    \"search\": \"vmqeopfuudtdsufvyvddq\",
    \"per_page\": 1
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/admin/skills"
);

const params = {
    "search": ""PHP"",
    "per_page": "15",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

let body = {
    "search": "vmqeopfuudtdsufvyvddq",
    "per_page": 1
};

fetch(url, {
    method: "GET",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-admin-skills">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Skills retrieved successfully&quot;,
    &quot;data&quot;: {
        &quot;data&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;name_ar&quot;: &quot;برمجة PHP&quot;,
                &quot;name_en&quot;: &quot;PHP Programming&quot;,
                &quot;category_id&quot;: 2,
                &quot;category&quot;: {
                    &quot;id&quot;: 2,
                    &quot;name_ar&quot;: &quot;برمجة&quot;,
                    &quot;name_en&quot;: &quot;Programming&quot;
                },
                &quot;created_at&quot;: &quot;2024-01-15T10:30:00.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2024-01-15T10:30:00.000000Z&quot;
            },
            {
                &quot;id&quot;: 2,
                &quot;name_ar&quot;: &quot;تصميم جرافيك&quot;,
                &quot;name_en&quot;: &quot;Graphic Design&quot;,
                &quot;category_id&quot;: 3,
                &quot;category&quot;: {
                    &quot;id&quot;: 3,
                    &quot;name_ar&quot;: &quot;تصميم&quot;,
                    &quot;name_en&quot;: &quot;Design&quot;
                },
                &quot;created_at&quot;: &quot;2024-01-16T14:20:00.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2024-01-16T14:20:00.000000Z&quot;
            }
        ],
        &quot;current_page&quot;: 1,
        &quot;first_page_url&quot;: &quot;http://127.0.0.1:8000/api/admin/skills?page=1&quot;,
        &quot;from&quot;: 1,
        &quot;last_page&quot;: 5,
        &quot;last_page_url&quot;: &quot;http://127.0.0.1:8000/api/admin/skills?page=5&quot;,
        &quot;next_page_url&quot;: &quot;http://127.0.0.1:8000/api/admin/skills?page=2&quot;,
        &quot;path&quot;: &quot;http://127.0.0.1:8000/api/admin/skills&quot;,
        &quot;per_page&quot;: 10,
        &quot;prev_page_url&quot;: null,
        &quot;to&quot;: 10,
        &quot;total&quot;: 50
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
  &quot;message&quot;: &quot;Search term must not exceed 255 characters&quot;,
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
  &quot;message&quot;: &quot;Unauthenticated&quot;,
  &quot;status&quot;: false,
  &quot;error_num&quot;: 401,
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-skills" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-skills"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-skills"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-skills" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-skills">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-skills" data-method="GET"
      data-path="api/admin/skills"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-skills', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-skills"
                    onclick="tryItOut('GETapi-admin-skills');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-skills"
                    onclick="cancelTryOut('GETapi-admin-skills');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-skills"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/skills</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-skills"
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
                              name="Accept"                data-endpoint="GETapi-admin-skills"
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
                              name="Accept-Language"                data-endpoint="GETapi-admin-skills"
               value="en"
               data-component="header">
    <br>
<p>Example: <code>en</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>search</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="search"                data-endpoint="GETapi-admin-skills"
               value=""PHP""
               data-component="query">
    <br>
<p>optional Search term to filter skills by name (Arabic or English). Example: <code>"PHP"</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-admin-skills"
               value="15"
               data-component="query">
    <br>
<p>optional Number of items per page (1-100). Defaults to 10. Example: <code>15</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>search</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="search"                data-endpoint="GETapi-admin-skills"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-admin-skills"
               value="1"
               data-component="body">
    <br>
<p>Must be at least 1. Must not be greater than 100. Example: <code>1</code></p>
        </div>
        </form>

                    <h2 id="admin-skills-management-POSTapi-admin-skills">Create New Skill</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Create a new skill in the system. Skills must have names in both Arabic and English
and must be associated with a valid category.</p>

<span id="example-requests-POSTapi-admin-skills">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://backend.shuwier.com/api/admin/skills" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en" \
    --data "{
    \"name_ar\": \"\\\"برمجة PHP\\\"\",
    \"name_en\": \"\\\"PHP Programming\\\"\",
    \"category_id\": 2
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/admin/skills"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

let body = {
    "name_ar": "\"برمجة PHP\"",
    "name_en": "\"PHP Programming\"",
    "category_id": 2
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-admin-skills">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Skill created successfully&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 15,
        &quot;name_ar&quot;: &quot;برمجة PHP&quot;,
        &quot;name_en&quot;: &quot;PHP Programming&quot;,
        &quot;category_id&quot;: 2,
        &quot;category&quot;: {
            &quot;id&quot;: 2,
            &quot;name_ar&quot;: &quot;برمجة&quot;,
            &quot;name_en&quot;: &quot;Programming&quot;
        },
        &quot;created_at&quot;: &quot;2024-01-20T09:15:30.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-01-20T09:15:30.000000Z&quot;
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
  &quot;message&quot;: &quot;The Arabic name has already been taken&quot;,
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
  &quot;status&quot;: false,
  &quot;error_num&quot;: 400,
  &quot;message&quot;: &quot;The name ar field is required&quot;,
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
  &quot;message&quot;: &quot;This category is not a parent category&quot;,
  &quot;status&quot;: false,
  &quot;error_num&quot;: 400,
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
  &quot;message&quot;: &quot;Unauthenticated&quot;,
  &quot;status&quot;: false,
  &quot;error_num&quot;: 401,
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-admin-skills" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-admin-skills"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-admin-skills"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-admin-skills" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-admin-skills">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-admin-skills" data-method="POST"
      data-path="api/admin/skills"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-admin-skills', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-admin-skills"
                    onclick="tryItOut('POSTapi-admin-skills');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-admin-skills"
                    onclick="cancelTryOut('POSTapi-admin-skills');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-admin-skills"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/admin/skills</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-admin-skills"
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
                              name="Accept"                data-endpoint="POSTapi-admin-skills"
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
                              name="Accept-Language"                data-endpoint="POSTapi-admin-skills"
               value="en"
               data-component="header">
    <br>
<p>Example: <code>en</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name_ar</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name_ar"                data-endpoint="POSTapi-admin-skills"
               value=""برمجة PHP""
               data-component="body">
    <br>
<p>The Arabic name of the skill. Must be unique and between 2-100 characters. Example: <code>"برمجة PHP"</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name_en</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name_en"                data-endpoint="POSTapi-admin-skills"
               value=""PHP Programming""
               data-component="body">
    <br>
<p>The English name of the skill. Must be unique and between 2-100 characters. Example: <code>"PHP Programming"</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>category_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="category_id"                data-endpoint="POSTapi-admin-skills"
               value="2"
               data-component="body">
    <br>
<p>The ID of the category this skill belongs to. Must exist in categories table. Example: <code>2</code></p>
        </div>
        </form>

                    <h2 id="admin-skills-management-GETapi-admin-skills--id-">Get Skill Details</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retrieve detailed information about a specific skill by its ID.
Returns the skill data including its associated category information.</p>

<span id="example-requests-GETapi-admin-skills--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://backend.shuwier.com/api/admin/skills/5" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/admin/skills/5"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-admin-skills--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Success&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 5,
        &quot;name_ar&quot;: &quot;تصميم واجهات المستخدم&quot;,
        &quot;name_en&quot;: &quot;UI Design&quot;,
        &quot;category_id&quot;: 3,
        &quot;category&quot;: {
            &quot;id&quot;: 3,
            &quot;name_ar&quot;: &quot;تصميم&quot;,
            &quot;name_en&quot;: &quot;Design&quot;
        },
        &quot;created_at&quot;: &quot;2024-01-18T16:45:22.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-01-19T10:30:15.000000Z&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
  &quot;message&quot;: &quot;Skill not found&quot;,
  &quot;status&quot;: false,
  &quot;error_num&quot;: 400,
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
  &quot;message&quot;: &quot;Unauthenticated&quot;,
  &quot;status&quot;: false,
  &quot;error_num&quot;: 401,
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-skills--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-skills--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-skills--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-skills--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-skills--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-skills--id-" data-method="GET"
      data-path="api/admin/skills/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-skills--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-skills--id-"
                    onclick="tryItOut('GETapi-admin-skills--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-skills--id-"
                    onclick="cancelTryOut('GETapi-admin-skills--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-skills--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/skills/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-skills--id-"
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
                              name="Accept"                data-endpoint="GETapi-admin-skills--id-"
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
                              name="Accept-Language"                data-endpoint="GETapi-admin-skills--id-"
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
               step="any"               name="id"                data-endpoint="GETapi-admin-skills--id-"
               value="5"
               data-component="url">
    <br>
<p>The ID of the skill to retrieve. Example: <code>5</code></p>
            </div>
                    </form>

                    <h2 id="admin-skills-management-PUTapi-admin-skills--id-">Update Skill</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Update an existing skill's information. You can modify the skill names (Arabic/English)
and change its category association. All fields are required for update.</p>

<span id="example-requests-PUTapi-admin-skills--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://backend.shuwier.com/api/admin/skills/5" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en" \
    --data "{
    \"name_ar\": \"\\\"تطوير تطبيقات PHP\\\"\",
    \"name_en\": \"\\\"PHP Application Development\\\"\",
    \"category_id\": 2
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/admin/skills/5"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

let body = {
    "name_ar": "\"تطوير تطبيقات PHP\"",
    "name_en": "\"PHP Application Development\"",
    "category_id": 2
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-admin-skills--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Skill updated successfully&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 5,
        &quot;name_ar&quot;: &quot;تطوير تطبيقات PHP&quot;,
        &quot;name_en&quot;: &quot;PHP Application Development&quot;,
        &quot;category_id&quot;: 2,
        &quot;category&quot;: {
            &quot;id&quot;: 2,
            &quot;name_ar&quot;: &quot;برمجة&quot;,
            &quot;name_en&quot;: &quot;Programming&quot;
        },
        &quot;created_at&quot;: &quot;2024-01-18T16:45:22.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-01-20T11:22:45.000000Z&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
  &quot;message&quot;: &quot;Skill not found&quot;,
  &quot;status&quot;: false,
  &quot;error_num&quot;: 400,
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
  &quot;message&quot;: &quot;This category is not a parent category&quot;,
  &quot;status&quot;: false,
  &quot;error_num&quot;: 400,
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
  &quot;message&quot;: &quot;Unauthenticated&quot;,
  &quot;status&quot;: false,
  &quot;error_num&quot;: 401,
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-admin-skills--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-admin-skills--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-admin-skills--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-admin-skills--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-admin-skills--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-admin-skills--id-" data-method="PUT"
      data-path="api/admin/skills/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-admin-skills--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-admin-skills--id-"
                    onclick="tryItOut('PUTapi-admin-skills--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-admin-skills--id-"
                    onclick="cancelTryOut('PUTapi-admin-skills--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-admin-skills--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/admin/skills/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/admin/skills/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-admin-skills--id-"
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
                              name="Accept"                data-endpoint="PUTapi-admin-skills--id-"
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
                              name="Accept-Language"                data-endpoint="PUTapi-admin-skills--id-"
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
               step="any"               name="id"                data-endpoint="PUTapi-admin-skills--id-"
               value="5"
               data-component="url">
    <br>
<p>The ID of the skill to update. Example: <code>5</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name_ar</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name_ar"                data-endpoint="PUTapi-admin-skills--id-"
               value=""تطوير تطبيقات PHP""
               data-component="body">
    <br>
<p>The updated Arabic name of the skill. Must be unique and between 2-100 characters. Example: <code>"تطوير تطبيقات PHP"</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name_en</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name_en"                data-endpoint="PUTapi-admin-skills--id-"
               value=""PHP Application Development""
               data-component="body">
    <br>
<p>The updated English name of the skill. Must be unique and between 2-100 characters. Example: <code>"PHP Application Development"</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>category_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="category_id"                data-endpoint="PUTapi-admin-skills--id-"
               value="2"
               data-component="body">
    <br>
<p>The ID of the category this skill should belong to. Must exist in categories table. Example: <code>2</code></p>
        </div>
        </form>

                    <h2 id="admin-skills-management-DELETEapi-admin-skills--id-">Delete Skill</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Permanently delete a skill from the system. This action cannot be undone.
Make sure the skill is not being used by any freelancers before deletion.</p>

<span id="example-requests-DELETEapi-admin-skills--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://backend.shuwier.com/api/admin/skills/8" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/admin/skills/8"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-admin-skills--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
  &quot;status&quot;: true,
  &quot;error_num&quot;: null,
  &quot;message&quot;: &quot;Skill deleted successfully&quot;,
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
  &quot;message&quot;: &quot;Skill not found&quot;,
  &quot;status&quot;: false,
  &quot;error_num&quot;: 400,
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
  &quot;message&quot;: &quot;Unauthenticated&quot;,
  &quot;status&quot;: false,
  &quot;error_num&quot;: 401,
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-admin-skills--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-admin-skills--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-admin-skills--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-admin-skills--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-admin-skills--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-admin-skills--id-" data-method="DELETE"
      data-path="api/admin/skills/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-admin-skills--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-admin-skills--id-"
                    onclick="tryItOut('DELETEapi-admin-skills--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-admin-skills--id-"
                    onclick="cancelTryOut('DELETEapi-admin-skills--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-admin-skills--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/admin/skills/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-admin-skills--id-"
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
                              name="Accept"                data-endpoint="DELETEapi-admin-skills--id-"
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
                              name="Accept-Language"                data-endpoint="DELETEapi-admin-skills--id-"
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
               step="any"               name="id"                data-endpoint="DELETEapi-admin-skills--id-"
               value="8"
               data-component="url">
    <br>
<p>The ID of the skill to delete. Example: <code>8</code></p>
            </div>
                    </form>

                <h1 id="admin-user-verification">Admin User Verification</h1>

    

                                <h2 id="admin-user-verification-GETapi-admin-verifications">Get User Verification Requests</h2>

<p>
</p>

<p>Retrieve a paginated list of user verification requests with optional status filtering.</p>

<span id="example-requests-GETapi-admin-verifications">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://backend.shuwier.com/api/admin/verifications?status=pending&amp;search=john" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/admin/verifications"
);

const params = {
    "status": "pending",
    "search": "john",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-admin-verifications">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;User verification requests retrieved successfully&quot;,
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;data&quot;: {
        &quot;current_page&quot;: 1,
        &quot;data&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;user_id&quot;: 1,
                &quot;document_one&quot;: &quot;path/to/document1.pdf&quot;,
                &quot;document_two&quot;: &quot;path/to/document2.pdf&quot;,
                &quot;status&quot;: &quot;pending&quot;,
                &quot;created_at&quot;: &quot;2025-09-15T10:00:00.000000Z&quot;
            }
        ],
        &quot;per_page&quot;: 10,
        &quot;total&quot;: 1
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Invalid status parameter&quot;,
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-verifications" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-verifications"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-verifications"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-verifications" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-verifications">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-verifications" data-method="GET"
      data-path="api/admin/verifications"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-verifications', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-verifications"
                    onclick="tryItOut('GETapi-admin-verifications');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-verifications"
                    onclick="cancelTryOut('GETapi-admin-verifications');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-verifications"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/verifications</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-verifications"
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
                              name="Accept"                data-endpoint="GETapi-admin-verifications"
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
                              name="Accept-Language"                data-endpoint="GETapi-admin-verifications"
               value="en"
               data-component="header">
    <br>
<p>Example: <code>en</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="GETapi-admin-verifications"
               value="pending"
               data-component="query">
    <br>
<p>Filter by verification status. Allowed values: pending, approved. Example: <code>pending</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>search</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="search"                data-endpoint="GETapi-admin-verifications"
               value="john"
               data-component="query">
    <br>
<p>Optional search term to filter requests by user name or email. Example: <code>john</code></p>
            </div>
                </form>

                    <h2 id="admin-user-verification-POSTapi-admin-verifications--id-">Accept or Reject User Verification</h2>

<p>
</p>

<p>Approve or reject a user verification request by ID.</p>

<span id="example-requests-POSTapi-admin-verifications--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://backend.shuwier.com/api/admin/verifications/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en" \
    --data "{
    \"action\": \"approved\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/admin/verifications/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

let body = {
    "action": "approved"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-admin-verifications--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;User verification request updated successfully&quot;,
    &quot;status&quot;: true,
    &quot;error_num&quot;: null
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Invalid action parameter&quot;,
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;not found&quot;,
    &quot;status&quot;: false,
    &quot;error_num&quot;: 404
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-admin-verifications--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-admin-verifications--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-admin-verifications--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-admin-verifications--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-admin-verifications--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-admin-verifications--id-" data-method="POST"
      data-path="api/admin/verifications/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-admin-verifications--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-admin-verifications--id-"
                    onclick="tryItOut('POSTapi-admin-verifications--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-admin-verifications--id-"
                    onclick="cancelTryOut('POSTapi-admin-verifications--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-admin-verifications--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/admin/verifications/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-admin-verifications--id-"
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
                              name="Accept"                data-endpoint="POSTapi-admin-verifications--id-"
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
                              name="Accept-Language"                data-endpoint="POSTapi-admin-verifications--id-"
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
               step="any"               name="id"                data-endpoint="POSTapi-admin-verifications--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the user verification request. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>action</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="action"                data-endpoint="POSTapi-admin-verifications--id-"
               value="approved"
               data-component="body">
    <br>
<p>The action to perform. Allowed values: approved, rejected. Example: <code>approved</code></p>
        </div>
        </form>

                <h1 id="categories">Categories</h1>

    <p>APIs for managing categories and retrieving category data</p>

                                <h2 id="categories-GETapi-categories">Get all parent categories</h2>

<p>
</p>

<p>Retrieve all parent categories available in the system. These are the main categories
that can contain subcategories. Use this endpoint to populate category dropdowns
in forms or display category lists.</p>

<span id="example-requests-GETapi-categories">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://backend.shuwier.com/api/categories" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/categories"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-categories">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Success&quot;,
    &quot;status&quot;: true,
    &quot;data&quot;: {
        &quot;data&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Web Development&quot;,
                &quot;description&quot;: &quot;Website and web application development&quot;,
                &quot;parent_id&quot;: null,
                &quot;subcategories&quot;: []
            },
            {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;Mobile Development&quot;,
                &quot;description&quot;: &quot;Mobile application development for iOS and Android&quot;,
                &quot;parent_id&quot;: null,
                &quot;subcategories&quot;: []
            },
            {
                &quot;id&quot;: 3,
                &quot;name&quot;: &quot;Graphic Design&quot;,
                &quot;description&quot;: &quot;Visual design and graphic arts&quot;,
                &quot;parent_id&quot;: null,
                &quot;subcategories&quot;: []
            }
        ]
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;An error occurred while retrieving categories&quot;,
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-categories" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-categories"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-categories"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-categories" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-categories">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-categories" data-method="GET"
      data-path="api/categories"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-categories', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-categories"
                    onclick="tryItOut('GETapi-categories');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-categories"
                    onclick="cancelTryOut('GETapi-categories');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-categories"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/categories</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-categories"
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
                              name="Accept"                data-endpoint="GETapi-categories"
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
                              name="Accept-Language"                data-endpoint="GETapi-categories"
               value="en"
               data-component="header">
    <br>
<p>Example: <code>en</code></p>
            </div>
                        </form>

                    <h2 id="categories-GETapi-categories-child--id-">Get subcategories</h2>

<p>
</p>

<p>Retrieve all subcategories that belong to a specific parent category. This endpoint is used
to get the child categories when a user selects a main category, allowing for hierarchical
category selection in forms and filters.</p>

<span id="example-requests-GETapi-categories-child--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://backend.shuwier.com/api/categories/child/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/categories/child/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-categories-child--id-">
            <blockquote>
            <p>Example response (200, Subcategories found successfully):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
  &quot;message&quot;: &quot;Success&quot;,
  &quot;status&quot;: true,
  &quot;data&quot;: {
    &quot;data&quot;: [
      {
        &quot;id&quot;: 4,
        &quot;name&quot;: &quot;Frontend Development&quot;,
        &quot;parent_id&quot;: 1,
      },
      {
        &quot;id&quot;: 5,
        &quot;name&quot;: &quot;Backend Development&quot;,
        &quot;parent_id&quot;: 1,
      },
      {
        &quot;id&quot;: 6,
        &quot;name&quot;: &quot;Full Stack Development&quot;,
        &quot;parent_id&quot;: 1,
      }
    ]
  }
}</code>
 </pre>
            <blockquote>
            <p>Example response (200, No subcategories found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Success&quot;,
    &quot;status&quot;: true,
    &quot;data&quot;: {
        &quot;data&quot;: []
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Invalid parent category ID):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Category not found&quot;,
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Server error):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;An error occurred while retrieving subcategories&quot;,
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-categories-child--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-categories-child--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-categories-child--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-categories-child--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-categories-child--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-categories-child--id-" data-method="GET"
      data-path="api/categories/child/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-categories-child--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-categories-child--id-"
                    onclick="tryItOut('GETapi-categories-child--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-categories-child--id-"
                    onclick="cancelTryOut('GETapi-categories-child--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-categories-child--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/categories/child/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-categories-child--id-"
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
                              name="Accept"                data-endpoint="GETapi-categories-child--id-"
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
                              name="Accept-Language"                data-endpoint="GETapi-categories-child--id-"
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
               step="any"               name="id"                data-endpoint="GETapi-categories-child--id-"
               value="1"
               data-component="url">
    <br>
<p>The parent category ID to get subcategories for. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="client-project-management">Client Project Management</h1>

    

                                <h2 id="client-project-management-GETapi-clients-projects">List client projects</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retrieve a paginated list of projects belonging to the authenticated client.
This endpoint allows clients to view and filter their posted projects by status
with optional pagination control. Results include complete project details
with categories, attachments, and user information.</p>

<span id="example-requests-GETapi-clients-projects">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://backend.shuwier.com/api/clients/projects?status=active&amp;per_page=10" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en" \
    --data "{
    \"status\": \"active\",
    \"per_page\": 73
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/clients/projects"
);

const params = {
    "status": "active",
    "per_page": "10",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

let body = {
    "status": "active",
    "per_page": 73
};

fetch(url, {
    method: "GET",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-clients-projects">
            <blockquote>
            <p>Example response (200, Projects retrieved successfully):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
  &quot;status&quot;: true,
  &quot;error_num&quot;: 200,
  &quot;message&quot;: &quot;Success&quot;,
  &quot;data&quot;: {
    &quot;current_page&quot;: 1,
    &quot;data&quot;: [
      {
        &quot;id&quot;: 5,
        &quot;title&quot;: &quot;E-commerce Website Development&quot;,
        &quot;description&quot;: &quot;I need a complete e-commerce website with product catalog, shopping cart, payment integration, and admin dashboard. The site should be responsive and SEO-optimized.&quot;,
        &quot;category_id&quot;: &quot;4&quot;,
        &quot;subcategory_id&quot;: &quot;5&quot;,
        &quot;budget&quot;: &quot;$1000-$2000&quot;,
        &quot;deadline_unit&quot;: &quot;days&quot;,
        &quot;deadline&quot;: &quot;12&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;comments_enabled&quot;: true,
        &quot;proposals_enabled&quot;: true,
        &quot;created_at&quot;: &quot;2025-10-06T09:11:11.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-10-06T09:11:11.000000Z&quot;,
        &quot;category&quot;: {
          &quot;id&quot;: 4,
          &quot;name&quot;: &quot;Design&quot;,
          &quot;image&quot;: &quot;storage/categories/68dd364f26e71.svg&quot;,
          &quot;parent_id&quot;: null,
          &quot;created_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;,
          &quot;updated_at&quot;: &quot;2025-10-01T14:10:23.000000Z&quot;
        },
        &quot;subcategory&quot;: {
          &quot;id&quot;: 5,
          &quot;name&quot;: &quot;Web&quot;,
          &quot;image&quot;: null,
          &quot;parent_id&quot;: 4,
          &quot;created_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;,
          &quot;updated_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;
        },
        &quot;attachments&quot;: [
          {
            &quot;id&quot;: 2,
            &quot;file_path&quot;: &quot;storage/projects/68e3876bcc657.PNG&quot;,
            &quot;user_id&quot;: 2,
            &quot;project_id&quot;: 5,
            &quot;created_at&quot;: &quot;2025-10-06T09:10:03.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-10-06T09:11:11.000000Z&quot;
          }
        ],
        &quot;user&quot;: {
          &quot;id&quot;: 2,
          &quot;name&quot;: &quot;Ahmed test&quot;,
          &quot;email&quot;: &quot;freelancer2@gmail.com&quot;,
          &quot;type&quot;: &quot;client&quot;,
          &quot;is_active&quot;: true,
          &quot;profile_picture&quot;: &quot;storage/profiles/68d28083a3dd1.PNG&quot;,
          &quot;company&quot;: &quot;شركة التقنيات المتقدمة&quot;,
          &quot;country&quot;: &quot;asd&quot;,
          &quot;city&quot;: &quot;asd&quot;,
          &quot;is_verified&quot;: false,
          &quot;user_verification_status&quot;: &quot;approved&quot;,
          &quot;created_at&quot;: &quot;2025-09-03T11:34:36.000000Z&quot;,
          &quot;updated_at&quot;: &quot;2025-09-23T11:12:03.000000Z&quot;
        }
      },
      {
        &quot;id&quot;: 3,
        &quot;title&quot;: &quot;Mobile App UI/UX Design&quot;,
        &quot;description&quot;: &quot;Looking for a talented designer to create modern and user-friendly UI/UX design for a mobile application.&quot;,
        &quot;category_id&quot;: &quot;2&quot;,
        &quot;subcategory_id&quot;: &quot;6&quot;,
        &quot;budget&quot;: &quot;$500-$800&quot;,
        &quot;deadline_unit&quot;: &quot;days&quot;,
        &quot;deadline&quot;: &quot;7&quot;,
        &quot;status&quot;: &quot;in_progress&quot;,
        &quot;comments_enabled&quot;: true,
        &quot;proposals_enabled&quot;: false,
        &quot;created_at&quot;: &quot;2025-10-05T14:20:30.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-10-06T08:15:45.000000Z&quot;,
        &quot;category&quot;: {
          &quot;id&quot;: 2,
          &quot;name&quot;: &quot;Design &amp; Creative&quot;,
          &quot;image&quot;: &quot;storage/categories/68dd364f26e72.svg&quot;,
          &quot;parent_id&quot;: null,
          &quot;created_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;,
          &quot;updated_at&quot;: &quot;2025-10-01T14:10:23.000000Z&quot;
        },
        &quot;subcategory&quot;: {
          &quot;id&quot;: 6,
          &quot;name&quot;: &quot;UI/UX Design&quot;,
          &quot;image&quot;: null,
          &quot;parent_id&quot;: 2,
          &quot;created_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;,
          &quot;updated_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;
        },
      }
    ],
    &quot;first_page_url&quot;: &quot;http://localhost/api/clients/projects?page=1&quot;,
    &quot;from&quot;: 1,
    &quot;last_page&quot;: 2,
    &quot;last_page_url&quot;: &quot;http://localhost/api/clients/projects?page=2&quot;,
    &quot;links&quot;: [
      {
        &quot;url&quot;: null,
        &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
        &quot;active&quot;: false
      },
      {
        &quot;url&quot;: &quot;http://localhost/api/clients/projects?page=1&quot;,
        &quot;label&quot;: &quot;1&quot;,
        &quot;active&quot;: true
      },
      {
        &quot;url&quot;: &quot;http://localhost/api/clients/projects?page=2&quot;,
        &quot;label&quot;: &quot;2&quot;,
        &quot;active&quot;: false
      },
      {
        &quot;url&quot;: &quot;http://localhost/api/clients/projects?page=2&quot;,
        &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
        &quot;active&quot;: false
      }
    ],
    &quot;next_page_url&quot;: &quot;http://localhost/api/clients/projects?page=2&quot;,
    &quot;path&quot;: &quot;http://localhost/api/clients/projects&quot;,
    &quot;per_page&quot;: 15,
    &quot;prev_page_url&quot;: null,
    &quot;to&quot;: 15,
    &quot;total&quot;: 23
  }
}</code>
 </pre>
            <blockquote>
            <p>Example response (200, No projects found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: 200,
    &quot;message&quot;: &quot;Success&quot;,
    &quot;data&quot;: {
        &quot;current_page&quot;: 1,
        &quot;data&quot;: [],
        &quot;first_page_url&quot;: &quot;http://localhost/api/clients/projects?page=1&quot;,
        &quot;from&quot;: null,
        &quot;last_page&quot;: 1,
        &quot;last_page_url&quot;: &quot;http://localhost/api/clients/projects?page=1&quot;,
        &quot;links&quot;: [
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost/api/clients/projects?page=1&quot;,
                &quot;label&quot;: &quot;1&quot;,
                &quot;active&quot;: true
            },
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
                &quot;active&quot;: false
            }
        ],
        &quot;next_page_url&quot;: null,
        &quot;path&quot;: &quot;http://localhost/api/clients/projects&quot;,
        &quot;per_page&quot;: 15,
        &quot;prev_page_url&quot;: null,
        &quot;to&quot;: null,
        &quot;total&quot;: 0
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Invalid status filter):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The selected status is invalid.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Invalid per_page parameter):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The per page field must be at least 1.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, Unauthenticated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 401,
    &quot;message&quot;: &quot;Unauthenticated&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Not a client):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 403,
    &quot;message&quot;: &quot;Access denied. Client role required.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-clients-projects" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-clients-projects"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-clients-projects"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-clients-projects" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-clients-projects">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-clients-projects" data-method="GET"
      data-path="api/clients/projects"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-clients-projects', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-clients-projects"
                    onclick="tryItOut('GETapi-clients-projects');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-clients-projects"
                    onclick="cancelTryOut('GETapi-clients-projects');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-clients-projects"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/clients/projects</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-clients-projects"
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
                              name="Accept"                data-endpoint="GETapi-clients-projects"
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
                              name="Accept-Language"                data-endpoint="GETapi-clients-projects"
               value="en"
               data-component="header">
    <br>
<p>Example: <code>en</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="GETapi-clients-projects"
               value="active"
               data-component="query">
    <br>
<p>optional Filter projects by status. Available values: active, in_progress, completed. Example: <code>active</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-clients-projects"
               value="10"
               data-component="query">
    <br>
<p>optional Number of projects per page (default: 15, minimum: 1). Example: <code>10</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="GETapi-clients-projects"
               value="active"
               data-component="body">
    <br>
<p>Example: <code>active</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>active</code></li> <li><code>in_progress</code></li> <li><code>completed</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-clients-projects"
               value="73"
               data-component="body">
    <br>
<p>Must be at least 1. Example: <code>73</code></p>
        </div>
        </form>

                    <h2 id="client-project-management-POSTapi-clients-projects">Create new project</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Create a new project posting for clients. This endpoint allows authenticated clients
to post new projects with detailed requirements including budget, deadline,
attachments, and category specifications. The project will be visible to freelancers
who can then submit proposals.</p>

<span id="example-requests-POSTapi-clients-projects">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://backend.shuwier.com/api/clients/projects" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en" \
    --data "{
    \"title\": \"E-commerce Website Development\",
    \"description\": \"I need a complete e-commerce website with product catalog, shopping cart, payment integration, and admin dashboard. The site should be responsive and SEO-optimized.\",
    \"category_id\": 4,
    \"subcategory_id\": 5,
    \"budget\": \"$1000-$2000\",
    \"deadline_unit\": \"days\",
    \"deadline\": 12,
    \"attachment_ids\": [
        2,
        3,
        4
    ]
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/clients/projects"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

let body = {
    "title": "E-commerce Website Development",
    "description": "I need a complete e-commerce website with product catalog, shopping cart, payment integration, and admin dashboard. The site should be responsive and SEO-optimized.",
    "category_id": 4,
    "subcategory_id": 5,
    "budget": "$1000-$2000",
    "deadline_unit": "days",
    "deadline": 12,
    "attachment_ids": [
        2,
        3,
        4
    ]
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-clients-projects">
            <blockquote>
            <p>Example response (200, Project created successfully):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: 200,
    &quot;message&quot;: &quot;Project created successfully&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 5,
        &quot;title&quot;: &quot;E-commerce Website Development&quot;,
        &quot;description&quot;: &quot;I need a complete e-commerce website with product catalog, shopping cart, payment integration, and admin dashboard. The site should be responsive and SEO-optimized with modern design and user-friendly interface.&quot;,
        &quot;category_id&quot;: &quot;4&quot;,
        &quot;subcategory_id&quot;: &quot;5&quot;,
        &quot;budget&quot;: &quot;$1000-$2000&quot;,
        &quot;deadline_unit&quot;: &quot;days&quot;,
        &quot;deadline&quot;: &quot;12&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;comments_enabled&quot;: true,
        &quot;proposals_enabled&quot;: true,
        &quot;created_at&quot;: &quot;2025-10-06T09:11:11.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-10-06T09:11:11.000000Z&quot;,
        &quot;category&quot;: {
            &quot;id&quot;: 4,
            &quot;name&quot;: &quot;Design&quot;,
            &quot;image&quot;: &quot;storage/categories/68dd364f26e71.svg&quot;,
            &quot;parent_id&quot;: null,
            &quot;created_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-10-01T14:10:23.000000Z&quot;
        },
        &quot;subcategory&quot;: {
            &quot;id&quot;: 5,
            &quot;name&quot;: &quot;Web&quot;,
            &quot;image&quot;: null,
            &quot;parent_id&quot;: 4,
            &quot;created_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;
        },
        &quot;attachments&quot;: [
            {
                &quot;id&quot;: 2,
                &quot;file_path&quot;: &quot;storage/projects/68e3876bcc657.PNG&quot;,
                &quot;user_id&quot;: 2,
                &quot;project_id&quot;: 5,
                &quot;created_at&quot;: &quot;2025-10-06T09:10:03.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-10-06T09:11:11.000000Z&quot;
            }
        ],
        &quot;user&quot;: {
            &quot;id&quot;: 2,
            &quot;name&quot;: &quot;Ahmed test&quot;,
            &quot;email&quot;: &quot;freelancer2@gmail.com&quot;,
            &quot;email_verified_at&quot;: &quot;2025-09-11T11:33:20.000000Z&quot;,
            &quot;phone&quot;: &quot;+966501234567&quot;,
            &quot;country_code&quot;: null,
            &quot;phone_number&quot;: null,
            &quot;type&quot;: &quot;client&quot;,
            &quot;is_active&quot;: true,
            &quot;about_me&quot;: &quot;Professional Full Stack Developer&quot;,
            &quot;profile_picture&quot;: &quot;storage/profiles/68d28083a3dd1.PNG&quot;,
            &quot;company&quot;: &quot;شركة التقنيات المتقدمة&quot;,
            &quot;country&quot;: &quot;asd&quot;,
            &quot;city&quot;: &quot;asd&quot;,
            &quot;is_verified&quot;: false,
            &quot;user_verification_status&quot;: &quot;approved&quot;,
            &quot;created_at&quot;: &quot;2025-09-03T11:34:36.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-23T11:12:03.000000Z&quot;,
            &quot;rate&quot;: 0,
            &quot;languages&quot;: null,
            &quot;reviews&quot;: null
        }
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Invalid category):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The selected category id is invalid.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Invalid subcategory):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The selected subcategory id is invalid.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Invalid attachment):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The selected attachment_ids.0 is invalid.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Validation error):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The title field is required.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Invalid deadline unit):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The selected deadline unit is invalid.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, Unauthenticated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 401,
    &quot;message&quot;: &quot;Unauthenticated&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-clients-projects" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-clients-projects"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-clients-projects"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-clients-projects" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-clients-projects">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-clients-projects" data-method="POST"
      data-path="api/clients/projects"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-clients-projects', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-clients-projects"
                    onclick="tryItOut('POSTapi-clients-projects');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-clients-projects"
                    onclick="cancelTryOut('POSTapi-clients-projects');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-clients-projects"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/clients/projects</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-clients-projects"
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
                              name="Accept"                data-endpoint="POSTapi-clients-projects"
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
                              name="Accept-Language"                data-endpoint="POSTapi-clients-projects"
               value="en"
               data-component="header">
    <br>
<p>Example: <code>en</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="POSTapi-clients-projects"
               value="E-commerce Website Development"
               data-component="body">
    <br>
<p>Project title - A clear and descriptive name for your project. Example: <code>E-commerce Website Development</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="POSTapi-clients-projects"
               value="I need a complete e-commerce website with product catalog, shopping cart, payment integration, and admin dashboard. The site should be responsive and SEO-optimized."
               data-component="body">
    <br>
<p>Detailed project description - Explain your project requirements, goals, and expectations (minimum characters required). Example: <code>I need a complete e-commerce website with product catalog, shopping cart, payment integration, and admin dashboard. The site should be responsive and SEO-optimized.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>category_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="category_id"                data-endpoint="POSTapi-clients-projects"
               value="4"
               data-component="body">
    <br>
<p>Main category ID - Must be a valid parent category that matches your project type. Example: <code>4</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>subcategory_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="subcategory_id"                data-endpoint="POSTapi-clients-projects"
               value="5"
               data-component="body">
    <br>
<p>optional Subcategory ID - Must belong to the selected main category for more specific categorization. Example: <code>5</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>budget</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="budget"                data-endpoint="POSTapi-clients-projects"
               value="$1000-$2000"
               data-component="body">
    <br>
<p>Project budget - Specify your budget range or fixed amount for this project. Example: <code>$1000-$2000</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>deadline_unit</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="deadline_unit"                data-endpoint="POSTapi-clients-projects"
               value="days"
               data-component="body">
    <br>
<p>Time unit for project deadline - The unit of measurement for your deadline. Must be one of: hours, days, weeks, months. Example: <code>days</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>deadline</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="deadline"                data-endpoint="POSTapi-clients-projects"
               value="12"
               data-component="body">
    <br>
<p>Project deadline - Number of units (hours/days/weeks/months) for project completion. Example: <code>12</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>attachment_ids</code></b>&nbsp;&nbsp;
<small>integer[]</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="attachment_ids[0]"                data-endpoint="POSTapi-clients-projects"
               data-component="body">
        <input type="number" style="display: none"
               name="attachment_ids[1]"                data-endpoint="POSTapi-clients-projects"
               data-component="body">
    <br>
<p>optional Array of attachment IDs - Files that provide additional project details (must be uploaded first using upload endpoint).</p>
        </div>
        </form>

                    <h2 id="client-project-management-GETapi-clients-projects--id-">Show project details</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retrieve detailed information about a specific project by ID. This endpoint
is accessible to both clients (owners) and authenticated freelancers who want
to view project details for potential proposals. Returns complete project
information including categories, attachments, and client details.</p>

<span id="example-requests-GETapi-clients-projects--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://backend.shuwier.com/api/clients/projects/5" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/clients/projects/5"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-clients-projects--id-">
            <blockquote>
            <p>Example response (200, Project retrieved successfully):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: 200,
    &quot;message&quot;: &quot;Success&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 5,
        &quot;title&quot;: &quot;E-commerce Website Development&quot;,
        &quot;description&quot;: &quot;I need a complete e-commerce website with product catalog, shopping cart, payment integration, and admin dashboard. The site should be responsive and SEO-optimized with modern design and user-friendly interface.&quot;,
        &quot;category_id&quot;: &quot;4&quot;,
        &quot;subcategory_id&quot;: &quot;5&quot;,
        &quot;budget&quot;: &quot;$1000-$2000&quot;,
        &quot;deadline_unit&quot;: &quot;days&quot;,
        &quot;deadline&quot;: &quot;12&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;comments_enabled&quot;: true,
        &quot;proposals_enabled&quot;: true,
        &quot;created_at&quot;: &quot;2025-10-06T09:11:11.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-10-06T09:11:11.000000Z&quot;,
        &quot;category&quot;: {
            &quot;id&quot;: 4,
            &quot;name&quot;: &quot;Design&quot;,
            &quot;image&quot;: &quot;storage/categories/68dd364f26e71.svg&quot;,
            &quot;parent_id&quot;: null,
            &quot;created_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-10-01T14:10:23.000000Z&quot;
        },
        &quot;subcategory&quot;: {
            &quot;id&quot;: 5,
            &quot;name&quot;: &quot;Web&quot;,
            &quot;image&quot;: null,
            &quot;parent_id&quot;: 4,
            &quot;created_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;
        },
        &quot;attachments&quot;: [
            {
                &quot;id&quot;: 2,
                &quot;file_path&quot;: &quot;storage/projects/68e3876bcc657.PNG&quot;,
                &quot;user_id&quot;: 2,
                &quot;project_id&quot;: 5,
                &quot;created_at&quot;: &quot;2025-10-06T09:10:03.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-10-06T09:11:11.000000Z&quot;
            },
            {
                &quot;id&quot;: 3,
                &quot;file_path&quot;: &quot;storage/projects/68e3876bcc658.PDF&quot;,
                &quot;user_id&quot;: 2,
                &quot;project_id&quot;: 5,
                &quot;created_at&quot;: &quot;2025-10-06T09:10:15.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-10-06T09:11:11.000000Z&quot;
            }
        ],
        &quot;user&quot;: {
            &quot;id&quot;: 2,
            &quot;name&quot;: &quot;Ahmed test&quot;,
            &quot;email&quot;: &quot;freelancer2@gmail.com&quot;,
            &quot;email_verified_at&quot;: &quot;2025-09-11T11:33:20.000000Z&quot;,
            &quot;phone&quot;: &quot;+966501234567&quot;,
            &quot;country_code&quot;: null,
            &quot;phone_number&quot;: null,
            &quot;type&quot;: &quot;client&quot;,
            &quot;is_active&quot;: true,
            &quot;about_me&quot;: &quot;Professional Full Stack Developer&quot;,
            &quot;profile_picture&quot;: &quot;storage/profiles/68d28083a3dd1.PNG&quot;,
            &quot;company&quot;: &quot;شركة التقنيات المتقدمة&quot;,
            &quot;country&quot;: &quot;asd&quot;,
            &quot;city&quot;: &quot;asd&quot;,
            &quot;is_verified&quot;: false,
            &quot;user_verification_status&quot;: &quot;approved&quot;,
            &quot;created_at&quot;: &quot;2025-09-03T11:34:36.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-23T11:12:03.000000Z&quot;,
            &quot;rate&quot;: 0,
            &quot;languages&quot;: null,
            &quot;reviews&quot;: null
        },
        &quot;proposals_count&quot;: 12,
        &quot;average_proposal_amount&quot;: &quot;$1200&quot;,
        &quot;project_visibility&quot;: &quot;public&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Invalid project ID):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;Invalid project ID provided&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, Unauthenticated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 401,
    &quot;message&quot;: &quot;Unauthenticated&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Access denied to private project):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 403,
    &quot;message&quot;: &quot;You do not have permission to view this project&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, Project not found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 404,
    &quot;message&quot;: &quot;Project not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-clients-projects--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-clients-projects--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-clients-projects--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-clients-projects--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-clients-projects--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-clients-projects--id-" data-method="GET"
      data-path="api/clients/projects/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-clients-projects--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-clients-projects--id-"
                    onclick="tryItOut('GETapi-clients-projects--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-clients-projects--id-"
                    onclick="cancelTryOut('GETapi-clients-projects--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-clients-projects--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/clients/projects/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-clients-projects--id-"
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
                              name="Accept"                data-endpoint="GETapi-clients-projects--id-"
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
                              name="Accept-Language"                data-endpoint="GETapi-clients-projects--id-"
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
               step="any"               name="id"                data-endpoint="GETapi-clients-projects--id-"
               value="5"
               data-component="url">
    <br>
<p>Project ID to retrieve. Example: <code>5</code></p>
            </div>
                    </form>

                    <h2 id="client-project-management-POSTapi-clients-projects--id--end">End project</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Mark a project as completed or ended by the client. This endpoint allows
the project owner (client) to close their project, stopping any further
proposal submissions and marking the project as finished. This action
is typically performed when the client has found a suitable freelancer
or decides to cancel the project.</p>

<span id="example-requests-POSTapi-clients-projects--id--end">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://backend.shuwier.com/api/clients/projects/5/end" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/clients/projects/5/end"
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

<span id="example-responses-POSTapi-clients-projects--id--end">
            <blockquote>
            <p>Example response (200, Project ended successfully):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Project ended successfully&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (200, Project already ended):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Project is already ended&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Cannot end project in current status):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Project cannot be ended in current status&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Invalid project ID):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Invalid project ID provided&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, Unauthenticated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 401,
    &quot;message&quot;: &quot;Unauthenticated&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Unauthorized - not project owner):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;You are not authorized to end this project&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Not a client):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 403,
    &quot;message&quot;: &quot;Access denied. Client role required.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, Project not found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Project not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-clients-projects--id--end" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-clients-projects--id--end"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-clients-projects--id--end"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-clients-projects--id--end" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-clients-projects--id--end">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-clients-projects--id--end" data-method="POST"
      data-path="api/clients/projects/{id}/end"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-clients-projects--id--end', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-clients-projects--id--end"
                    onclick="tryItOut('POSTapi-clients-projects--id--end');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-clients-projects--id--end"
                    onclick="cancelTryOut('POSTapi-clients-projects--id--end');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-clients-projects--id--end"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/clients/projects/{id}/end</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-clients-projects--id--end"
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
                              name="Accept"                data-endpoint="POSTapi-clients-projects--id--end"
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
                              name="Accept-Language"                data-endpoint="POSTapi-clients-projects--id--end"
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
               step="any"               name="id"                data-endpoint="POSTapi-clients-projects--id--end"
               value="5"
               data-component="url">
    <br>
<p>The ID of the project to end. Must be owned by the authenticated client. Example: <code>5</code></p>
            </div>
                    </form>

                <h1 id="client-proposal-management">Client Proposal Management</h1>

    

                                <h2 id="client-proposal-management-GETapi-clients-projects--projectId--proposals">List project proposals</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retrieve a paginated list of proposals submitted for a specific project owned by the client.
This endpoint allows clients to view all proposals received for their projects,
helping them evaluate and compare different freelancer offers. Each proposal includes
freelancer information, bid details, attachments, and reviews.</p>

<span id="example-requests-GETapi-clients-projects--projectId--proposals">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://backend.shuwier.com/api/clients/projects/5/proposals?per_page=10" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en" \
    --data "{
    \"per_page\": 21
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/clients/projects/5/proposals"
);

const params = {
    "per_page": "10",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

let body = {
    "per_page": 21
};

fetch(url, {
    method: "GET",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-clients-projects--projectId--proposals">
            <blockquote>
            <p>Example response (200, Proposals retrieved successfully):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Success&quot;,
    &quot;data&quot;: {
        &quot;current_page&quot;: 1,
        &quot;data&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;cover_letter&quot;: &quot;I have 5+ years of experience in e-commerce development using Laravel and Vue.js. I have built similar platforms with payment integration and can deliver this project within your timeline.&quot;,
                &quot;estimated_time_unit&quot;: &quot;days&quot;,
                &quot;estimated_time&quot;: 14,
                &quot;fees_type&quot;: &quot;fixed&quot;,
                &quot;bid_amount&quot;: &quot;1500.00&quot;,
                &quot;status&quot;: &quot;pending&quot;,
                &quot;created_at&quot;: &quot;2025-10-07T10:36:03.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-10-07T10:37:27.000000Z&quot;,
                &quot;freelancer&quot;: {
                    &quot;id&quot;: 3,
                    &quot;name&quot;: &quot;Ahmed test&quot;,
                    &quot;email&quot;: &quot;freelancer3@gmail.com&quot;,
                    &quot;profile_picture&quot;: &quot;storage/profiles/68d27bc809cf4.png&quot;,
                    &quot;headline&quot;: &quot;Professional Freelancer&quot;,
                    &quot;rate&quot;: 4.67,
                    &quot;approval_status&quot;: &quot;approved&quot;,
                    &quot;category&quot;: {
                        &quot;id&quot;: 4,
                        &quot;name&quot;: &quot;Design&quot;,
                        &quot;image&quot;: &quot;storage/categories/68dd364f26e71.svg&quot;
                    },
                    &quot;reviews_count&quot;: 3,
                    &quot;completed_projects&quot;: 15
                },
                &quot;attachments&quot;: [
                    {
                        &quot;id&quot;: 1,
                        &quot;file_path&quot;: &quot;storage/proposals/68e4ed13c9536.PNG&quot;,
                        &quot;created_at&quot;: &quot;2025-10-07T10:36:03.000000Z&quot;
                    }
                ]
            }
        ],
        &quot;first_page_url&quot;: &quot;http://localhost/api/clients/projects/5/proposals?page=1&quot;,
        &quot;from&quot;: 1,
        &quot;last_page&quot;: 2,
        &quot;last_page_url&quot;: &quot;http://localhost/api/clients/projects/5/proposals?page=2&quot;,
        &quot;links&quot;: [
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost/api/clients/projects/5/proposals?page=1&quot;,
                &quot;label&quot;: &quot;1&quot;,
                &quot;active&quot;: true
            },
            {
                &quot;url&quot;: &quot;http://localhost/api/clients/projects/5/proposals?page=2&quot;,
                &quot;label&quot;: &quot;2&quot;,
                &quot;active&quot;: false
            }
        ],
        &quot;next_page_url&quot;: &quot;http://localhost/api/clients/projects/5/proposals?page=2&quot;,
        &quot;path&quot;: &quot;http://localhost/api/clients/projects/5/proposals&quot;,
        &quot;per_page&quot;: 15,
        &quot;prev_page_url&quot;: null,
        &quot;to&quot;: 15,
        &quot;total&quot;: 28
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (200, No proposals found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;No proposals found for this project&quot;,
    &quot;data&quot;: {
        &quot;current_page&quot;: 1,
        &quot;data&quot;: [],
        &quot;first_page_url&quot;: &quot;http://localhost/api/clients/projects/5/proposals?page=1&quot;,
        &quot;from&quot;: null,
        &quot;last_page&quot;: 1,
        &quot;last_page_url&quot;: &quot;http://localhost/api/clients/projects/5/proposals?page=1&quot;,
        &quot;next_page_url&quot;: null,
        &quot;path&quot;: &quot;http://localhost/api/clients/projects/5/proposals&quot;,
        &quot;per_page&quot;: 15,
        &quot;prev_page_url&quot;: null,
        &quot;to&quot;: null,
        &quot;total&quot;: 0
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Invalid per_page parameter):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The per page field must be between 1 and 50.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, Unauthenticated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 401,
    &quot;message&quot;: &quot;Unauthenticated&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Not project owner):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;You are not authorized to view proposals for this project&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Not a client):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 403,
    &quot;message&quot;: &quot;Access denied. Client role required.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, Project not found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;Project not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-clients-projects--projectId--proposals" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-clients-projects--projectId--proposals"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-clients-projects--projectId--proposals"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-clients-projects--projectId--proposals" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-clients-projects--projectId--proposals">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-clients-projects--projectId--proposals" data-method="GET"
      data-path="api/clients/projects/{projectId}/proposals"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-clients-projects--projectId--proposals', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-clients-projects--projectId--proposals"
                    onclick="tryItOut('GETapi-clients-projects--projectId--proposals');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-clients-projects--projectId--proposals"
                    onclick="cancelTryOut('GETapi-clients-projects--projectId--proposals');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-clients-projects--projectId--proposals"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/clients/projects/{projectId}/proposals</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-clients-projects--projectId--proposals"
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
                              name="Accept"                data-endpoint="GETapi-clients-projects--projectId--proposals"
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
                              name="Accept-Language"                data-endpoint="GETapi-clients-projects--projectId--proposals"
               value="en"
               data-component="header">
    <br>
<p>Example: <code>en</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>projectId</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="projectId"                data-endpoint="GETapi-clients-projects--projectId--proposals"
               value="5"
               data-component="url">
    <br>
<p>The ID of the project to get proposals for. Must be owned by the authenticated client. Example: <code>5</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-clients-projects--projectId--proposals"
               value="10"
               data-component="query">
    <br>
<p>optional Number of proposals per page (default: 15, minimum: 1, maximum: 50). Example: <code>10</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-clients-projects--projectId--proposals"
               value="21"
               data-component="body">
    <br>
<p>Must be at least 1. Must not be greater than 50. Example: <code>21</code></p>
        </div>
        </form>

                    <h2 id="client-proposal-management-GETapi-clients-proposals--id-">Show proposal details</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retrieve detailed information about a specific proposal submitted to the client's project.
This endpoint provides comprehensive proposal details including cover letter, bid amount,
freelancer profile with reviews, attachments, and project information. Clients use this
to evaluate individual proposals and make hiring decisions.</p>

<span id="example-requests-GETapi-clients-proposals--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://backend.shuwier.com/api/clients/proposals/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/clients/proposals/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-clients-proposals--id-">
            <blockquote>
            <p>Example response (200, Proposal details retrieved successfully):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Success&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;cover_letter&quot;: &quot;I have 5+ years of experience in e-commerce development using Laravel and Vue.js. I have built similar platforms with payment integration and can deliver this project within your timeline.&quot;,
        &quot;estimated_time_unit&quot;: &quot;days&quot;,
        &quot;estimated_time&quot;: 14,
        &quot;fees_type&quot;: &quot;fixed&quot;,
        &quot;bid_amount&quot;: &quot;1500.00&quot;,
        &quot;project_id&quot;: 5,
        &quot;status&quot;: &quot;viewed&quot;,
        &quot;created_at&quot;: &quot;2025-10-07T10:36:03.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-10-07T10:37:27.000000Z&quot;,
        &quot;project&quot;: {
            &quot;id&quot;: 5,
            &quot;title&quot;: &quot;E-commerce Website Development&quot;,
            &quot;description&quot;: &quot;I need a complete e-commerce website with product catalog, shopping cart, payment integration, and admin dashboard. The site should be responsive and SEO-optimized.&quot;,
            &quot;category_id&quot;: 4,
            &quot;subcategory_id&quot;: 5,
            &quot;budget&quot;: &quot;$1000-$2000&quot;,
            &quot;deadline_unit&quot;: &quot;days&quot;,
            &quot;deadline&quot;: 12,
            &quot;status&quot;: &quot;active&quot;,
            &quot;comments_enabled&quot;: true,
            &quot;proposals_enabled&quot;: true,
            &quot;submited_proposal_count&quot;: 8,
            &quot;created_at&quot;: &quot;2025-10-06T09:11:11.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-10-06T09:11:11.000000Z&quot;
        },
        &quot;attachments&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;file_path&quot;: &quot;storage/proposals/68e4ed13c9536.PNG&quot;,
                &quot;user_id&quot;: 3,
                &quot;proposal_id&quot;: 1,
                &quot;created_at&quot;: &quot;2025-10-07T10:36:03.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-10-07T10:37:27.000000Z&quot;
            },
            {
                &quot;id&quot;: 2,
                &quot;file_path&quot;: &quot;storage/proposals/68e4ed166e064.PNG&quot;,
                &quot;user_id&quot;: 3,
                &quot;proposal_id&quot;: 1,
                &quot;created_at&quot;: &quot;2025-10-07T10:36:06.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-10-07T10:37:27.000000Z&quot;
            }
        ],
        &quot;user&quot;: {
            &quot;id&quot;: 3,
            &quot;name&quot;: &quot;Ahmed test&quot;,
            &quot;email&quot;: &quot;freelancer3@gmail.com&quot;,
            &quot;type&quot;: &quot;freelancer&quot;,
            &quot;email_verified_at&quot;: &quot;2025-09-21T09:56:16.000000Z&quot;,
            &quot;phone&quot;: &quot;1234567893&quot;,
            &quot;is_active&quot;: true,
            &quot;about_me&quot;: &quot;Experienced freelancer with skills in various domains.&quot;,
            &quot;profile_picture&quot;: &quot;storage/profiles/68d27bc809cf4.png&quot;,
            &quot;approval_status&quot;: &quot;approved&quot;,
            &quot;country&quot;: null,
            &quot;city&quot;: null,
            &quot;linkedin_link&quot;: &quot;https://linkedin.com/in/freelancer3&quot;,
            &quot;twitter_link&quot;: null,
            &quot;other_freelance_platform_links&quot;: [],
            &quot;portfolio_link&quot;: &quot;https://portfolio.freelancer3.com&quot;,
            &quot;headline&quot;: &quot;Professional Freelancer&quot;,
            &quot;is_verified&quot;: false,
            &quot;user_verification_status&quot;: null,
            &quot;rate&quot;: 4.67,
            &quot;created_at&quot;: &quot;2025-09-03T11:34:37.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-23T10:51:52.000000Z&quot;,
            &quot;category&quot;: {
                &quot;id&quot;: 4,
                &quot;name&quot;: &quot;Design&quot;,
                &quot;image&quot;: &quot;storage/categories/68dd364f26e71.svg&quot;,
                &quot;parent_id&quot;: null,
                &quot;created_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-10-01T14:10:23.000000Z&quot;
            },
            &quot;languages&quot;: null,
            &quot;reviews&quot;: [
                {
                    &quot;id&quot;: 3,
                    &quot;user_id&quot;: 2,
                    &quot;rating&quot;: 5,
                    &quot;comment&quot;: &quot;Excellent freelancer! Very professional and delivered high-quality work on time. Great communication skills and attention to detail. Highly recommended for WordPress development projects.&quot;,
                    &quot;user&quot;: {
                        &quot;id&quot;: 2,
                        &quot;name&quot;: &quot;Ahmed test&quot;,
                        &quot;email&quot;: &quot;freelancer2@gmail.com&quot;,
                        &quot;type&quot;: &quot;client&quot;,
                        &quot;profile_picture&quot;: &quot;storage/profiles/68d28083a3dd1.PNG&quot;,
                        &quot;company&quot;: &quot;شركة التقنيات المتقدمة&quot;,
                        &quot;created_at&quot;: &quot;2025-09-03T11:34:36.000000Z&quot;
                    },
                    &quot;created_at&quot;: &quot;2025-10-05T12:47:53.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-10-05T12:47:53.000000Z&quot;
                },
                {
                    &quot;id&quot;: 4,
                    &quot;user_id&quot;: 4,
                    &quot;rating&quot;: 4,
                    &quot;comment&quot;: &quot;Good work overall. The project was completed within the deadline and met most of our requirements. Would work with this freelancer again.&quot;,
                    &quot;user&quot;: {
                        &quot;id&quot;: 4,
                        &quot;name&quot;: &quot;Freelancer4&quot;,
                        &quot;email&quot;: &quot;freelancer4@example.com&quot;,
                        &quot;type&quot;: &quot;freelancer&quot;,
                        &quot;created_at&quot;: &quot;2025-09-03T11:34:37.000000Z&quot;
                    },
                    &quot;created_at&quot;: &quot;2025-10-05T12:48:33.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-10-05T12:48:33.000000Z&quot;
                },
                {
                    &quot;id&quot;: 5,
                    &quot;user_id&quot;: 7,
                    &quot;rating&quot;: 5,
                    &quot;comment&quot;: &quot;Outstanding developer! Exceeded expectations with creative solutions and clean code. Fast delivery and excellent communication throughout the project.&quot;,
                    &quot;user&quot;: {
                        &quot;id&quot;: 7,
                        &quot;name&quot;: &quot;Freelancer7&quot;,
                        &quot;email&quot;: &quot;freelancer7@example.com&quot;,
                        &quot;type&quot;: &quot;freelancer&quot;,
                        &quot;created_at&quot;: &quot;2025-09-03T11:34:38.000000Z&quot;
                    },
                    &quot;created_at&quot;: &quot;2025-10-05T12:48:33.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-10-05T12:48:33.000000Z&quot;
                }
            ]
        }
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Invalid proposal ID):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;Invalid proposal ID provided&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, Unauthenticated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 401,
    &quot;message&quot;: &quot;Unauthenticated&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Not authorized to view proposal):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;You are not authorized to view this proposal&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Not a client):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 403,
    &quot;message&quot;: &quot;Access denied. Client role required.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, Proposal not found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;Proposal not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-clients-proposals--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-clients-proposals--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-clients-proposals--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-clients-proposals--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-clients-proposals--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-clients-proposals--id-" data-method="GET"
      data-path="api/clients/proposals/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-clients-proposals--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-clients-proposals--id-"
                    onclick="tryItOut('GETapi-clients-proposals--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-clients-proposals--id-"
                    onclick="cancelTryOut('GETapi-clients-proposals--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-clients-proposals--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/clients/proposals/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-clients-proposals--id-"
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
                              name="Accept"                data-endpoint="GETapi-clients-proposals--id-"
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
                              name="Accept-Language"                data-endpoint="GETapi-clients-proposals--id-"
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
               step="any"               name="id"                data-endpoint="GETapi-clients-proposals--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the proposal to retrieve. Must be for a project owned by the authenticated client. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="commissions">Commissions</h1>

    

                                <h2 id="commissions-GETapi-commissions">Get current commission rates</h2>

<p>
</p>

<p>Retrieve the latest commission rates and fee structure used by the platform.
This endpoint provides information about platform commission percentages,
payment processing fees, and other charges that apply to transactions.
This information is typically used for calculating final amounts in proposals,
payments, and displaying fee breakdowns to users.</p>

<span id="example-requests-GETapi-commissions">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://backend.shuwier.com/api/commissions" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/commissions"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-commissions">
            <blockquote>
            <p>Example response (200, Commission rates retrieved successfully):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
  &quot;status&quot;: true,
  &quot;error_num&quot;: null,
  &quot;message&quot;: &quot;Commission rates retrieved successfully&quot;,
  &quot;data&quot;: {
    &quot;id&quot;: 1,
    &quot;rate&quot;: 10.0,
    &quot;effective_from&quot;: &quot;2025-10-01T00:00:00.000000Z&quot;,
    &quot;created_by&quot;: 1,
    &quot;created_at&quot;: &quot;2025-09-28T10:30:00.000000Z&quot;,
    &quot;updated_at&quot;: &quot;2025-10-01T14:20:00.000000Z&quot;,
  }
}</code>
 </pre>
            <blockquote>
            <p>Example response (200, No commission rates found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;No commission rates configured&quot;,
    &quot;data&quot;: null
}</code>
 </pre>
            <blockquote>
            <p>Example response (500, Server error):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 500,
    &quot;message&quot;: &quot;Unable to retrieve commission rates&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-commissions" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-commissions"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-commissions"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-commissions" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-commissions">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-commissions" data-method="GET"
      data-path="api/commissions"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-commissions', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-commissions"
                    onclick="tryItOut('GETapi-commissions');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-commissions"
                    onclick="cancelTryOut('GETapi-commissions');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-commissions"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/commissions</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-commissions"
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
                              name="Accept"                data-endpoint="GETapi-commissions"
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
                              name="Accept-Language"                data-endpoint="GETapi-commissions"
               value="en"
               data-component="header">
    <br>
<p>Example: <code>en</code></p>
            </div>
                        </form>

                <h1 id="endpoints">Endpoints</h1>

    

                                <h2 id="endpoints-GETapi-freelancers-proposals--id-">GET api/freelancers/proposals/{id}</h2>

<p>
</p>



<span id="example-requests-GETapi-freelancers-proposals--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://backend.shuwier.com/api/freelancers/proposals/consequatur" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/freelancers/proposals/consequatur"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-freelancers-proposals--id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 401,
    &quot;message&quot;: &quot;Unauthenticated&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-freelancers-proposals--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-freelancers-proposals--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-freelancers-proposals--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-freelancers-proposals--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-freelancers-proposals--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-freelancers-proposals--id-" data-method="GET"
      data-path="api/freelancers/proposals/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-freelancers-proposals--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-freelancers-proposals--id-"
                    onclick="tryItOut('GETapi-freelancers-proposals--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-freelancers-proposals--id-"
                    onclick="cancelTryOut('GETapi-freelancers-proposals--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-freelancers-proposals--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/freelancers/proposals/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-freelancers-proposals--id-"
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
                              name="Accept"                data-endpoint="GETapi-freelancers-proposals--id-"
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
                              name="Accept-Language"                data-endpoint="GETapi-freelancers-proposals--id-"
               value="en"
               data-component="header">
    <br>
<p>Example: <code>en</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="GETapi-freelancers-proposals--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the proposal. Example: <code>consequatur</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-services--id-">GET api/services/{id}</h2>

<p>
</p>



<span id="example-requests-GETapi-services--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://backend.shuwier.com/api/services/consequatur" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/services/consequatur"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-services--id-">
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 404,
    &quot;message&quot;: &quot;Not Found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-services--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-services--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-services--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-services--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-services--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-services--id-" data-method="GET"
      data-path="api/services/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-services--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-services--id-"
                    onclick="tryItOut('GETapi-services--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-services--id-"
                    onclick="cancelTryOut('GETapi-services--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-services--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/services/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-services--id-"
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
                              name="Accept"                data-endpoint="GETapi-services--id-"
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
                              name="Accept-Language"                data-endpoint="GETapi-services--id-"
               value="en"
               data-component="header">
    <br>
<p>Example: <code>en</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="GETapi-services--id-"
               value="consequatur"
               data-component="url">
    <br>
<p>The ID of the service. Example: <code>consequatur</code></p>
            </div>
                    </form>

                <h1 id="file-upload">File Upload</h1>

    <p>APIs for handling file uploads</p>

                                <h2 id="file-upload-POSTapi-upload">Upload file</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Upload files for different purposes like portfolios, profile pictures, etc.
The uploaded file will be stored and return file information including the file path and attachment ID.</p>

<span id="example-requests-POSTapi-upload">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://backend.shuwier.com/api/upload" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --header "Accept-Language: en" \
    --form "type=portfolio"\
    --form "file=@/private/var/folders/bh/ymm81xv929z74_28m5_265d40000gn/T/phpHN3TKS" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/upload"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
    "Accept-Language": "en",
};

const body = new FormData();
body.append('type', 'portfolio');
body.append('file', document.querySelector('input[name="file"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-upload">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;File uploaded successfully&quot;,
    &quot;status&quot;: true,
    &quot;data&quot;: {
        &quot;id&quot;: 15,
        &quot;file_path&quot;: &quot;storage/portfolios/66e1a5c4e8b47.jpg&quot;,
        &quot;user_id&quot;: 1,
        &quot;portfolio_id&quot;: null,
        &quot;created_at&quot;: &quot;2024-09-11T10:30:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-09-11T10:30:00.000000Z&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The file field is required.&quot;,
    &quot;status&quot;: false,
    &quot;error_code&quot;: 400
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The selected type is invalid.&quot;,
    &quot;status&quot;: false,
    &quot;error_code&quot;: 400
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The file may not be greater than 5120 kilobytes.&quot;,
    &quot;status&quot;: false,
    &quot;error_code&quot;: 400
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-upload" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-upload"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-upload"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-upload" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-upload">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-upload" data-method="POST"
      data-path="api/upload"
      data-authed="1"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-upload', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-upload"
                    onclick="tryItOut('POSTapi-upload');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-upload"
                    onclick="cancelTryOut('POSTapi-upload');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-upload"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/upload</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-upload"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-upload"
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
                              name="Accept-Language"                data-endpoint="POSTapi-upload"
               value="en"
               data-component="header">
    <br>
<p>Example: <code>en</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>file</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="file"                data-endpoint="POSTapi-upload"
               value=""
               data-component="body">
    <br>
<p>The file to upload (PDF, JPEG, JPG, PNG, GIF, DOC, DOCX, XLS, XLSX, max 5MB). Example: Example: <code>/private/var/folders/bh/ymm81xv929z74_28m5_265d40000gn/T/phpHN3TKS</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="type"                data-endpoint="POSTapi-upload"
               value="portfolio"
               data-component="body">
    <br>
<p>The upload type. Currently supports: portfolio, profile_picture, document, cv, certificate. Example: <code>portfolio</code></p>
        </div>
        </form>

                <h1 id="freelancer-projects">Freelancer Projects</h1>

    

                                <h2 id="freelancer-projects-GETapi-freelancers-projects--id-">Show project details to freelancer</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retrieve detailed information about a specific project for freelancers to view.
This endpoint provides all the necessary information for freelancers to understand
the project requirements and decide whether to submit a proposal. The response
includes project details, client information, category data, attachments, and
current proposal statistics.</p>

<span id="example-requests-GETapi-freelancers-projects--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://backend.shuwier.com/api/freelancers/projects/5" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/freelancers/projects/5"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-freelancers-projects--id-">
            <blockquote>
            <p>Example response (200, Project details retrieved successfully):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Project retrieved successfully&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 5,
        &quot;title&quot;: &quot;E-commerce Website Development&quot;,
        &quot;description&quot;: &quot;I need a complete e-commerce website with product catalog, shopping cart, payment integration, and admin dashboard. The site should be responsive and SEO-optimized with modern design principles.&quot;,
        &quot;category_id&quot;: &quot;4&quot;,
        &quot;subcategory_id&quot;: &quot;5&quot;,
        &quot;budget&quot;: &quot;$1000-$2000&quot;,
        &quot;deadline_unit&quot;: &quot;days&quot;,
        &quot;deadline&quot;: &quot;12&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;comments_enabled&quot;: true,
        &quot;proposals_enabled&quot;: true,
        &quot;created_at&quot;: &quot;2025-10-06T09:11:11.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-10-06T09:11:11.000000Z&quot;,
        &quot;category&quot;: {
            &quot;id&quot;: 4,
            &quot;name&quot;: &quot;Programming&quot;,
            &quot;image&quot;: &quot;storage/categories/68dd364f26e71.svg&quot;,
            &quot;parent_id&quot;: null,
            &quot;created_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-10-01T14:10:23.000000Z&quot;
        },
        &quot;subcategory&quot;: {
            &quot;id&quot;: 5,
            &quot;name&quot;: &quot;Web Development&quot;,
            &quot;image&quot;: null,
            &quot;parent_id&quot;: 4,
            &quot;created_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;
        },
        &quot;attachments&quot;: [
            {
                &quot;id&quot;: 2,
                &quot;file_path&quot;: &quot;storage/projects/68e3876bcc657.PNG&quot;,
                &quot;user_id&quot;: 2,
                &quot;project_id&quot;: 5,
                &quot;created_at&quot;: &quot;2025-10-06T09:10:03.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-10-06T09:11:11.000000Z&quot;
            },
            {
                &quot;id&quot;: 3,
                &quot;file_path&quot;: &quot;storage/projects/68e3876bcc658.pdf&quot;,
                &quot;user_id&quot;: 2,
                &quot;project_id&quot;: 5,
                &quot;created_at&quot;: &quot;2025-10-06T09:10:05.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-10-06T09:11:11.000000Z&quot;
            }
        ],
        &quot;user&quot;: {
            &quot;id&quot;: 2,
            &quot;name&quot;: &quot;Ahmed Test&quot;,
            &quot;email&quot;: &quot;client@example.com&quot;,
            &quot;type&quot;: &quot;client&quot;,
            &quot;is_active&quot;: true,
            &quot;profile_picture&quot;: &quot;storage/profiles/68d28083a3dd1.PNG&quot;,
            &quot;company&quot;: &quot;Tech Solutions Ltd&quot;,
            &quot;country&quot;: &quot;Egypt&quot;,
            &quot;city&quot;: &quot;Cairo&quot;,
            &quot;is_verified&quot;: true,
            &quot;user_verification_status&quot;: &quot;approved&quot;,
            &quot;created_at&quot;: &quot;2025-09-03T11:34:36.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-23T11:12:03.000000Z&quot;
        },
        &quot;proposals_count&quot;: 8,
        &quot;time_remaining&quot;: &quot;5 days left&quot;,
        &quot;can_submit_proposal&quot;: true,
        &quot;freelancer_proposal_status&quot;: null
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Project not available for proposals):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;This project is no longer accepting proposals&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Project is completed or cancelled):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;This project is not available for viewing&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, Unauthenticated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 401,
    &quot;message&quot;: &quot;Unauthenticated&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Access denied - not a freelancer):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 403,
    &quot;message&quot;: &quot;Access denied. This endpoint is only available for freelancers.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, Project not found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 404,
    &quot;message&quot;: &quot;Project not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-freelancers-projects--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-freelancers-projects--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-freelancers-projects--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-freelancers-projects--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-freelancers-projects--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-freelancers-projects--id-" data-method="GET"
      data-path="api/freelancers/projects/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-freelancers-projects--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-freelancers-projects--id-"
                    onclick="tryItOut('GETapi-freelancers-projects--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-freelancers-projects--id-"
                    onclick="cancelTryOut('GETapi-freelancers-projects--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-freelancers-projects--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/freelancers/projects/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-freelancers-projects--id-"
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
                              name="Accept"                data-endpoint="GETapi-freelancers-projects--id-"
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
                              name="Accept-Language"                data-endpoint="GETapi-freelancers-projects--id-"
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
               step="any"               name="id"                data-endpoint="GETapi-freelancers-projects--id-"
               value="5"
               data-component="url">
    <br>
<p>The ID of the project to retrieve. Example: <code>5</code></p>
            </div>
                    </form>

                <h1 id="freelancer-proposals">Freelancer Proposals</h1>

    

                                <h2 id="freelancer-proposals-GETapi-freelancers-proposals">List freelancer proposals</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retrieve a paginated list of proposals submitted by the authenticated freelancer.
This endpoint allows freelancers to view and filter their submitted proposals
with search functionality and status filtering. Results include complete proposal
details with associated project information, status updates, and client responses.</p>

<span id="example-requests-GETapi-freelancers-proposals">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://backend.shuwier.com/api/freelancers/proposals?status=pending&amp;search=website+development&amp;per_page=10" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/freelancers/proposals"
);

const params = {
    "status": "pending",
    "search": "website development",
    "per_page": "10",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-freelancers-proposals">
            <blockquote>
            <p>Example response (200, Proposals retrieved successfully):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Proposals retrieved successfully&quot;,
    &quot;data&quot;: {
        &quot;current_page&quot;: 1,
        &quot;data&quot;: [
            {
                &quot;id&quot;: 15,
                &quot;cover_letter&quot;: &quot;I have 5+ years of experience in e-commerce development using Laravel and Vue.js. I&#039;ve built similar platforms with payment integration and can deliver this project within your timeline.&quot;,
                &quot;estimated_time_unit&quot;: &quot;days&quot;,
                &quot;estimated_time&quot;: 14,
                &quot;fees_type&quot;: &quot;fixed&quot;,
                &quot;bid_amount&quot;: &quot;1500.00&quot;,
                &quot;status&quot;: &quot;pending&quot;,
                &quot;created_at&quot;: &quot;2025-10-07T10:30:00.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-10-07T10:30:00.000000Z&quot;,
                &quot;project&quot;: {
                    &quot;id&quot;: 5,
                    &quot;title&quot;: &quot;E-commerce Website Development&quot;,
                    &quot;description&quot;: &quot;I need a complete e-commerce website with product catalog, shopping cart, payment integration, and admin dashboard.&quot;,
                    &quot;budget&quot;: &quot;$1000-$2000&quot;,
                    &quot;deadline_unit&quot;: &quot;days&quot;,
                    &quot;deadline&quot;: &quot;12&quot;,
                    &quot;status&quot;: &quot;active&quot;,
                    &quot;proposals_count&quot;: 8,
                    &quot;category&quot;: {
                        &quot;id&quot;: 4,
                        &quot;name&quot;: &quot;Programming&quot;
                    },
                    &quot;user&quot;: {
                        &quot;id&quot;: 2,
                        &quot;name&quot;: &quot;Ahmed Test&quot;,
                        &quot;company&quot;: &quot;Tech Solutions Ltd&quot;,
                        &quot;profile_picture&quot;: &quot;storage/profiles/68d28083a3dd1.PNG&quot;,
                        &quot;is_verified&quot;: true
                    }
                },
                &quot;attachments&quot;: [
                    {
                        &quot;id&quot;: 2,
                        &quot;file_path&quot;: &quot;storage/proposals/68e3876bcc657.PDF&quot;,
                        &quot;file_name&quot;: &quot;portfolio_sample.pdf&quot;,
                        &quot;created_at&quot;: &quot;2025-10-07T10:29:45.000000Z&quot;
                    }
                ],
                &quot;response_received&quot;: false,
                &quot;days_since_submission&quot;: 2,
                &quot;competition_level&quot;: &quot;medium&quot;
            },
            {
                &quot;id&quot;: 12,
                &quot;cover_letter&quot;: &quot;I&#039;m a UI/UX designer with expertise in mobile app design. I can create a modern, user-friendly interface that will enhance user experience.&quot;,
                &quot;estimated_time_unit&quot;: &quot;days&quot;,
                &quot;estimated_time&quot;: 7,
                &quot;fees_type&quot;: &quot;fixed&quot;,
                &quot;bid_amount&quot;: &quot;750.00&quot;,
                &quot;status&quot;: &quot;accepted&quot;,
                &quot;created_at&quot;: &quot;2025-10-05T14:20:00.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-10-06T16:45:00.000000Z&quot;,
                &quot;project&quot;: {
                    &quot;id&quot;: 3,
                    &quot;title&quot;: &quot;Mobile App UI/UX Design&quot;,
                    &quot;description&quot;: &quot;Looking for a talented designer to create modern and user-friendly UI/UX design for a mobile application.&quot;,
                    &quot;budget&quot;: &quot;$500-$800&quot;,
                    &quot;deadline_unit&quot;: &quot;days&quot;,
                    &quot;deadline&quot;: &quot;7&quot;,
                    &quot;status&quot;: &quot;in_progress&quot;,
                    &quot;proposals_count&quot;: 5,
                    &quot;category&quot;: {
                        &quot;id&quot;: 2,
                        &quot;name&quot;: &quot;Design &amp; Creative&quot;
                    },
                    &quot;user&quot;: {
                        &quot;id&quot;: 8,
                        &quot;name&quot;: &quot;Sarah Johnson&quot;,
                        &quot;company&quot;: &quot;FitTech Solutions&quot;,
                        &quot;profile_picture&quot;: &quot;storage/profiles/68d28083a3dd2.PNG&quot;,
                        &quot;is_verified&quot;: true
                    }
                },
                &quot;attachments&quot;: [],
                &quot;response_received&quot;: true,
                &quot;days_since_submission&quot;: 5,
                &quot;competition_level&quot;: &quot;low&quot;
            }
        ],
        &quot;first_page_url&quot;: &quot;http://localhost/api/freelancers/proposals?page=1&quot;,
        &quot;from&quot;: 1,
        &quot;last_page&quot;: 3,
        &quot;last_page_url&quot;: &quot;http://localhost/api/freelancers/proposals?page=3&quot;,
        &quot;links&quot;: [
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost/api/freelancers/proposals?page=1&quot;,
                &quot;label&quot;: &quot;1&quot;,
                &quot;active&quot;: true
            },
            {
                &quot;url&quot;: &quot;http://localhost/api/freelancers/proposals?page=2&quot;,
                &quot;label&quot;: &quot;2&quot;,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost/api/freelancers/proposals?page=2&quot;,
                &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
                &quot;active&quot;: false
            }
        ],
        &quot;next_page_url&quot;: &quot;http://localhost/api/freelancers/proposals?page=2&quot;,
        &quot;path&quot;: &quot;http://localhost/api/freelancers/proposals&quot;,
        &quot;per_page&quot;: 16,
        &quot;prev_page_url&quot;: null,
        &quot;to&quot;: 16,
        &quot;total&quot;: 42
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (200, No proposals found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;No proposals found&quot;,
    &quot;data&quot;: {
        &quot;current_page&quot;: 1,
        &quot;data&quot;: [],
        &quot;first_page_url&quot;: &quot;http://localhost/api/freelancers/proposals?page=1&quot;,
        &quot;from&quot;: null,
        &quot;last_page&quot;: 1,
        &quot;last_page_url&quot;: &quot;http://localhost/api/freelancers/proposals?page=1&quot;,
        &quot;links&quot;: [
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost/api/freelancers/proposals?page=1&quot;,
                &quot;label&quot;: &quot;1&quot;,
                &quot;active&quot;: true
            },
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
                &quot;active&quot;: false
            }
        ],
        &quot;next_page_url&quot;: null,
        &quot;path&quot;: &quot;http://localhost/api/freelancers/proposals&quot;,
        &quot;per_page&quot;: 16,
        &quot;prev_page_url&quot;: null,
        &quot;to&quot;: null,
        &quot;total&quot;: 0
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Invalid status filter):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The selected status is invalid.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Invalid per_page parameter):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The per page field must be between 1 and 50.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, Unauthenticated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 401,
    &quot;message&quot;: &quot;Unauthenticated&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Not a freelancer):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 403,
    &quot;message&quot;: &quot;Access denied. Freelancer role required.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Freelancer not approved):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 403,
    &quot;message&quot;: &quot;Your freelancer account is not approved yet.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-freelancers-proposals" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-freelancers-proposals"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-freelancers-proposals"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-freelancers-proposals" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-freelancers-proposals">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-freelancers-proposals" data-method="GET"
      data-path="api/freelancers/proposals"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-freelancers-proposals', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-freelancers-proposals"
                    onclick="tryItOut('GETapi-freelancers-proposals');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-freelancers-proposals"
                    onclick="cancelTryOut('GETapi-freelancers-proposals');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-freelancers-proposals"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/freelancers/proposals</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-freelancers-proposals"
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
                              name="Accept"                data-endpoint="GETapi-freelancers-proposals"
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
                              name="Accept-Language"                data-endpoint="GETapi-freelancers-proposals"
               value="en"
               data-component="header">
    <br>
<p>Example: <code>en</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="GETapi-freelancers-proposals"
               value="pending"
               data-component="query">
    <br>
<p>optional Filter proposals by status. Available values: pending, accepted, rejected, withdrawn. Example: <code>pending</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>search</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="search"                data-endpoint="GETapi-freelancers-proposals"
               value="website development"
               data-component="query">
    <br>
<p>optional Search proposals by project title, cover letter content, or project description keywords. Example: <code>website development</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-freelancers-proposals"
               value="10"
               data-component="query">
    <br>
<p>optional Number of proposals per page (default: 16, minimum: 1, maximum: 50). Example: <code>10</code></p>
            </div>
                </form>

                    <h2 id="freelancer-proposals-POSTapi-freelancers-proposals">Store Proposal</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Submit a proposal for a specific project. This endpoint allows authenticated freelancers
to submit their bid and proposal details for client projects. The proposal includes
cover letter, estimated time, bid amount, and optional attachments. Freelancers can
only submit one proposal per project, and the project must be accepting proposals.</p>

<span id="example-requests-POSTapi-freelancers-proposals">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://backend.shuwier.com/api/freelancers/proposals" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en" \
    --data "{
    \"cover_letter\": \"I have 5+ years of experience in e-commerce development using Laravel and Vue.js. I\'ve built similar platforms with payment integration and can deliver this project within your timeline.\",
    \"estimated_time_unit\": \"days\",
    \"estimated_time\": 14,
    \"fees_type\": \"fixed\",
    \"bid_amount\": \"1500.00\",
    \"project_id\": 5,
    \"attachment_ids\": [
        2,
        3,
        4
    ]
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/freelancers/proposals"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

let body = {
    "cover_letter": "I have 5+ years of experience in e-commerce development using Laravel and Vue.js. I've built similar platforms with payment integration and can deliver this project within your timeline.",
    "estimated_time_unit": "days",
    "estimated_time": 14,
    "fees_type": "fixed",
    "bid_amount": "1500.00",
    "project_id": 5,
    "attachment_ids": [
        2,
        3,
        4
    ]
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-freelancers-proposals">
            <blockquote>
            <p>Example response (200, Proposal submitted successfully):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
  &quot;status&quot;: true,
  &quot;error_num&quot;: null,
  &quot;message&quot;: &quot;Proposal submitted successfully&quot;,
  &quot;data&quot;: {
    &quot;id&quot;: 15,
    &quot;cover_letter&quot;: &quot;I have 5+ years of experience in e-commerce development using Laravel and Vue.js. I&#039;ve built similar platforms with payment integration and can deliver this project within your timeline. My portfolio includes 12+ successful e-commerce projects.&quot;,
    &quot;estimated_time_unit&quot;: &quot;days&quot;,
    &quot;estimated_time&quot;: 14,
    &quot;fees_type&quot;: &quot;fixed&quot;,
    &quot;bid_amount&quot;: &quot;1500.00&quot;,
    &quot;status&quot;: &quot;submitted&quot;,
    &quot;created_at&quot;: &quot;2025-10-07T10:30:00.000000Z&quot;,
    &quot;updated_at&quot;: &quot;2025-10-07T10:30:00.000000Z&quot;,
    &quot;project&quot;: {
      &quot;id&quot;: 5,
      &quot;title&quot;: &quot;E-commerce Website Development&quot;,
      &quot;budget&quot;: &quot;$1000-$2000&quot;,
      &quot;deadline_unit&quot;: &quot;days&quot;,
      &quot;deadline&quot;: &quot;12&quot;,
      &quot;status&quot;: &quot;active&quot;,
      &quot;category&quot;: {
        &quot;id&quot;: 4,
        &quot;name&quot;: &quot;Programming&quot;
      }
    },
    &quot;user&quot;: {
      &quot;id&quot;: 7,
      &quot;name&quot;: &quot;Mohammad Ali&quot;,
      &quot;profile_picture&quot;: &quot;storage/profiles/68d28083a3dd3.PNG&quot;,
      &quot;rating&quot;: 4.8,
      &quot;completed_projects&quot;: 23,
      &quot;location&quot;: &quot;Cairo, Egypt&quot;
    },
    &quot;attachments&quot;: [
      {
        &quot;id&quot;: 2,
        &quot;file_path&quot;: &quot;storage/proposals/68e3876bcc657.PDF&quot;,
        &quot;file_name&quot;: &quot;portfolio_sample.pdf&quot;,
        &quot;user_id&quot;: 7,
        &quot;proposal_id&quot;: 15,
        &quot;created_at&quot;: &quot;2025-10-07T10:29:45.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-10-07T10:30:00.000000Z&quot;
      }
    ],
  }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Already submitted proposal):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;You have already submitted a proposal for this project&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Project not accepting proposals):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;This project is no longer accepting proposals&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Invalid project):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The selected project id is invalid.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Own project):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;You cannot submit a proposal for your own project&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Invalid attachment):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The selected attachment_ids.0 is invalid.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Validation error):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The cover letter field is required.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Invalid bid amount):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The bid amount must be a positive number.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Invalid fees type):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The selected fees type is invalid.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Invalid time unit):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The selected estimated time unit is invalid.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, Unauthenticated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 401,
    &quot;message&quot;: &quot;Unauthenticated&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Not a freelancer):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 403,
    &quot;message&quot;: &quot;Access denied. Freelancer role required.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Freelancer not approved):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 403,
    &quot;message&quot;: &quot;Your freelancer account is not approved yet.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-freelancers-proposals" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-freelancers-proposals"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-freelancers-proposals"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-freelancers-proposals" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-freelancers-proposals">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-freelancers-proposals" data-method="POST"
      data-path="api/freelancers/proposals"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-freelancers-proposals', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-freelancers-proposals"
                    onclick="tryItOut('POSTapi-freelancers-proposals');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-freelancers-proposals"
                    onclick="cancelTryOut('POSTapi-freelancers-proposals');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-freelancers-proposals"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/freelancers/proposals</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-freelancers-proposals"
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
                              name="Accept"                data-endpoint="POSTapi-freelancers-proposals"
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
                              name="Accept-Language"                data-endpoint="POSTapi-freelancers-proposals"
               value="en"
               data-component="header">
    <br>
<p>Example: <code>en</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>cover_letter</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="cover_letter"                data-endpoint="POSTapi-freelancers-proposals"
               value="I have 5+ years of experience in e-commerce development using Laravel and Vue.js. I've built similar platforms with payment integration and can deliver this project within your timeline."
               data-component="body">
    <br>
<p>Detailed cover letter explaining your approach, experience, and why you're the best fit for this project. Example: <code>I have 5+ years of experience in e-commerce development using Laravel and Vue.js. I've built similar platforms with payment integration and can deliver this project within your timeline.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>estimated_time_unit</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="estimated_time_unit"                data-endpoint="POSTapi-freelancers-proposals"
               value="days"
               data-component="body">
    <br>
<p>Time unit for delivery estimate. Must be one of: hours, days, weeks, months. Example: <code>days</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>estimated_time</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="estimated_time"                data-endpoint="POSTapi-freelancers-proposals"
               value="14"
               data-component="body">
    <br>
<p>Number of time units needed to complete the project. Example: <code>14</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>fees_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="fees_type"                data-endpoint="POSTapi-freelancers-proposals"
               value="fixed"
               data-component="body">
    <br>
<p>Type of pricing structure. Must be one of: fixed, hourly. Example: <code>fixed</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>bid_amount</code></b>&nbsp;&nbsp;
<small>numeric</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="bid_amount"                data-endpoint="POSTapi-freelancers-proposals"
               value="1500.00"
               data-component="body">
    <br>
<p>Your bid amount for the project in USD. Must be a positive number. Example: <code>1500.00</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>project_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="project_id"                data-endpoint="POSTapi-freelancers-proposals"
               value="5"
               data-component="body">
    <br>
<p>ID of the project you're submitting a proposal for. Must be an active project accepting proposals. Example: <code>5</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>attachment_ids</code></b>&nbsp;&nbsp;
<small>integer[]</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="attachment_ids[0]"                data-endpoint="POSTapi-freelancers-proposals"
               data-component="body">
        <input type="number" style="display: none"
               name="attachment_ids[1]"                data-endpoint="POSTapi-freelancers-proposals"
               data-component="body">
    <br>
<p>optional Array of attachment IDs to include with your proposal (portfolio samples, certificates, etc.). Files must be uploaded first using upload endpoint.</p>
        </div>
        </form>

                <h1 id="hashtags">Hashtags</h1>

    <p>APIs for managing hashtags and searching hashtag data</p>

                                <h2 id="hashtags-GETapi-hashtags">Search hashtags</h2>

<p>
</p>

<p>Search for hashtags by name/keyword with pagination. This endpoint is used to find existing hashtags
when creating portfolios or filtering content. Returns hashtags that match the search term.
Results are limited to 50 items per request for performance.</p>

<span id="example-requests-GETapi-hashtags">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://backend.shuwier.com/api/hashtags?search=react" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en" \
    --data "{
    \"search\": \"vmqeopfuudtdsufvyvddq\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/hashtags"
);

const params = {
    "search": "react",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

let body = {
    "search": "vmqeopfuudtdsufvyvddq"
};

fetch(url, {
    method: "GET",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-hashtags">
            <blockquote>
            <p>Example response (200, Hashtags found successfully):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Success&quot;,
    &quot;status&quot;: true,
    &quot;data&quot;: {
        &quot;data&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;react&quot;
            },
            {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;reactjs&quot;
            },
            {
                &quot;id&quot;: 3,
                &quot;name&quot;: &quot;react-native&quot;
            }
        ]
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (200, No hashtags found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Success&quot;,
    &quot;status&quot;: true,
    &quot;data&quot;: {
        &quot;data&quot;: []
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Validation error - Missing search parameter):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The search field is required.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Validation error - Search term too long):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The search may not be greater than 50 characters.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (500, Server error):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;An error occurred while searching hashtags&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-hashtags" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-hashtags"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-hashtags"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-hashtags" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-hashtags">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-hashtags" data-method="GET"
      data-path="api/hashtags"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-hashtags', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-hashtags"
                    onclick="tryItOut('GETapi-hashtags');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-hashtags"
                    onclick="cancelTryOut('GETapi-hashtags');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-hashtags"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/hashtags</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-hashtags"
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
                              name="Accept"                data-endpoint="GETapi-hashtags"
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
                              name="Accept-Language"                data-endpoint="GETapi-hashtags"
               value="en"
               data-component="header">
    <br>
<p>Example: <code>en</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>search</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="search"                data-endpoint="GETapi-hashtags"
               value="react"
               data-component="query">
    <br>
<p>The search term to look for hashtags. Minimum 1 character, maximum 50 characters. Example: <code>react</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>search</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="search"                data-endpoint="GETapi-hashtags"
               value="vmqeopfuudtdsufvyvddq"
               data-component="body">
    <br>
<p>Must not be greater than 50 characters. Example: <code>vmqeopfuudtdsufvyvddq</code></p>
        </div>
        </form>

                <h1 id="languages">Languages</h1>

    

                                <h2 id="languages-GETapi-languages">Get All Languages</h2>

<p>
</p>

<p>Retrieve a list of all available languages in the system.</p>

<span id="example-requests-GETapi-languages">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://backend.shuwier.com/api/languages" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/languages"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-languages">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Languages retrieved successfully&quot;,
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;English&quot;,
            &quot;code&quot;: &quot;en&quot;,
            &quot;created_at&quot;: &quot;2025-09-15T10:00:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-15T10:00:00.000000Z&quot;
        },
        {
            &quot;id&quot;: 2,
            &quot;name&quot;: &quot;Arabic&quot;,
            &quot;code&quot;: &quot;ar&quot;,
            &quot;created_at&quot;: &quot;2025-09-15T10:00:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-15T10:00:00.000000Z&quot;
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-languages" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-languages"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-languages"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-languages" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-languages">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-languages" data-method="GET"
      data-path="api/languages"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-languages', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-languages"
                    onclick="tryItOut('GETapi-languages');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-languages"
                    onclick="cancelTryOut('GETapi-languages');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-languages"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/languages</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-languages"
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
                              name="Accept"                data-endpoint="GETapi-languages"
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
                              name="Accept-Language"                data-endpoint="GETapi-languages"
               value="en"
               data-component="header">
    <br>
<p>Example: <code>en</code></p>
            </div>
                        </form>

                <h1 id="portfolio-management">Portfolio Management</h1>

    <p>APIs for managing freelancer portfolios</p>

                                <h2 id="portfolio-management-GETapi-freelancers-portfolios">Get user portfolios</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retrieve all portfolios for the authenticated freelancer with pagination.</p>

<span id="example-requests-GETapi-freelancers-portfolios">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://backend.shuwier.com/api/freelancers/portfolios?per_page=15" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/freelancers/portfolios"
);

const params = {
    "per_page": "15",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-freelancers-portfolios">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Success&quot;,
    &quot;status&quot;: true,
    &quot;data&quot;: {
        &quot;data&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;title&quot;: &quot;E-commerce Website&quot;,
                &quot;description&quot;: &quot;Modern responsive e-commerce website&quot;,
                &quot;category&quot;: {
                    &quot;id&quot;: 1,
                    &quot;name&quot;: &quot;Web Development&quot;
                },
                &quot;subcategory&quot;: {
                    &quot;id&quot;: 2,
                    &quot;name&quot;: &quot;Frontend&quot;
                },
                &quot;hashtags&quot;: [
                    &quot;#react&quot;,
                    &quot;#ecommerce&quot;
                ],
                &quot;attachments&quot;: [
                    {
                        &quot;id&quot;: 1,
                        &quot;file_path&quot;: &quot;storage/portfolios/image1.jpg&quot;
                    }
                ]
            }
        ],
        &quot;current_page&quot;: 1,
        &quot;per_page&quot;: 10,
        &quot;total&quot;: 25
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-freelancers-portfolios" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-freelancers-portfolios"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-freelancers-portfolios"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-freelancers-portfolios" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-freelancers-portfolios">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-freelancers-portfolios" data-method="GET"
      data-path="api/freelancers/portfolios"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-freelancers-portfolios', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-freelancers-portfolios"
                    onclick="tryItOut('GETapi-freelancers-portfolios');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-freelancers-portfolios"
                    onclick="cancelTryOut('GETapi-freelancers-portfolios');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-freelancers-portfolios"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/freelancers/portfolios</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-freelancers-portfolios"
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
                              name="Accept"                data-endpoint="GETapi-freelancers-portfolios"
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
                              name="Accept-Language"                data-endpoint="GETapi-freelancers-portfolios"
               value="en"
               data-component="header">
    <br>
<p>Example: <code>en</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-freelancers-portfolios"
               value="15"
               data-component="query">
    <br>
<p>Number of portfolios per page. Default is 10. Example: <code>15</code></p>
            </div>
                </form>

                    <h2 id="portfolio-management-POSTapi-freelancers-portfolios">Create new portfolio</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Create a new portfolio for the authenticated freelancer.</p>

<span id="example-requests-POSTapi-freelancers-portfolios">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://backend.shuwier.com/api/freelancers/portfolios" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en" \
    --data "{
    \"title\": \"\\\"E-commerce Website\\\"\",
    \"description\": \"\\\"A modern responsive e-commerce website built with React and Laravel\\\"\",
    \"category_id\": 1,
    \"subcategory_id\": 2,
    \"attachment_ids\": [
        15,
        16,
        17
    ],
    \"cover_id\": 20,
    \"hashtags\": [
        \"react\",
        \"ecommerce\",
        \"laravel\"
    ]
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/freelancers/portfolios"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

let body = {
    "title": "\"E-commerce Website\"",
    "description": "\"A modern responsive e-commerce website built with React and Laravel\"",
    "category_id": 1,
    "subcategory_id": 2,
    "attachment_ids": [
        15,
        16,
        17
    ],
    "cover_id": 20,
    "hashtags": [
        "react",
        "ecommerce",
        "laravel"
    ]
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-freelancers-portfolios">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Portfolio created successfully&quot;,
    &quot;status&quot;: true,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;title&quot;: &quot;E-commerce Website&quot;,
        &quot;description&quot;: &quot;A modern responsive e-commerce website&quot;,
        &quot;category&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Web Development&quot;
        },
        &quot;subcategory&quot;: {
            &quot;id&quot;: 2,
            &quot;name&quot;: &quot;Frontend&quot;
        },
        &quot;hashtags&quot;: [
            &quot;#react&quot;,
            &quot;#ecommerce&quot;
        ],
        &quot;attachments&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;file_path&quot;: &quot;storage/portfolios/image1.jpg&quot;
            }
        ]
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;This category is not a parent category&quot;,
    &quot;status&quot;: false,
    &quot;error_code&quot;: 400
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;This subcategory does not belong to the selected category&quot;,
    &quot;status&quot;: false,
    &quot;error_code&quot;: 400
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-freelancers-portfolios" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-freelancers-portfolios"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-freelancers-portfolios"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-freelancers-portfolios" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-freelancers-portfolios">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-freelancers-portfolios" data-method="POST"
      data-path="api/freelancers/portfolios"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-freelancers-portfolios', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-freelancers-portfolios"
                    onclick="tryItOut('POSTapi-freelancers-portfolios');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-freelancers-portfolios"
                    onclick="cancelTryOut('POSTapi-freelancers-portfolios');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-freelancers-portfolios"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/freelancers/portfolios</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-freelancers-portfolios"
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
                              name="Accept"                data-endpoint="POSTapi-freelancers-portfolios"
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
                              name="Accept-Language"                data-endpoint="POSTapi-freelancers-portfolios"
               value="en"
               data-component="header">
    <br>
<p>Example: <code>en</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="POSTapi-freelancers-portfolios"
               value=""E-commerce Website""
               data-component="body">
    <br>
<p>The portfolio title (max 255 characters). Example: <code>"E-commerce Website"</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="POSTapi-freelancers-portfolios"
               value=""A modern responsive e-commerce website built with React and Laravel""
               data-component="body">
    <br>
<p>The portfolio description. Example: <code>"A modern responsive e-commerce website built with React and Laravel"</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>category_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="category_id"                data-endpoint="POSTapi-freelancers-portfolios"
               value="1"
               data-component="body">
    <br>
<p>The main category ID (must be a parent category). Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>subcategory_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="subcategory_id"                data-endpoint="POSTapi-freelancers-portfolios"
               value="2"
               data-component="body">
    <br>
<p>optional The subcategory ID (must belong to the selected category). Example: <code>2</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>attachment_ids</code></b>&nbsp;&nbsp;
<small>integer[]</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="attachment_ids[0]"                data-endpoint="POSTapi-freelancers-portfolios"
               data-component="body">
        <input type="number" style="display: none"
               name="attachment_ids[1]"                data-endpoint="POSTapi-freelancers-portfolios"
               data-component="body">
    <br>
<p>optional Array of attachment IDs from uploaded files (max 8 files). Use /api/upload endpoint first to upload files and get IDs.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>cover_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="cover_id"                data-endpoint="POSTapi-freelancers-portfolios"
               value="20"
               data-component="body">
    <br>
<p>The attachment ID to set as the cover image. Example: <code>20</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>hashtags</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="hashtags[0]"                data-endpoint="POSTapi-freelancers-portfolios"
               data-component="body">
        <input type="text" style="display: none"
               name="hashtags[1]"                data-endpoint="POSTapi-freelancers-portfolios"
               data-component="body">
    <br>
<p>optional Array of hashtag strings (max 255 characters each).</p>
        </div>
        </form>

                    <h2 id="portfolio-management-GETapi-freelancers-portfolios--id-">Get specific portfolio</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retrieve a specific portfolio by its ID with all related data.</p>

<span id="example-requests-GETapi-freelancers-portfolios--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://backend.shuwier.com/api/freelancers/portfolios/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/freelancers/portfolios/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-freelancers-portfolios--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Success&quot;,
    &quot;status&quot;: true,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;title&quot;: &quot;E-commerce Website&quot;,
        &quot;description&quot;: &quot;A modern responsive e-commerce website&quot;,
        &quot;category&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Web Development&quot;
        },
        &quot;subcategory&quot;: {
            &quot;id&quot;: 2,
            &quot;name&quot;: &quot;Frontend&quot;
        },
        &quot;hashtags&quot;: [
            &quot;#react&quot;,
            &quot;#ecommerce&quot;
        ],
        &quot;attachments&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;file_path&quot;: &quot;storage/portfolios/image1.jpg&quot;
            }
        ]
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Portfolio not found&quot;,
    &quot;status&quot;: false,
    &quot;error_code&quot;: 400
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-freelancers-portfolios--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-freelancers-portfolios--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-freelancers-portfolios--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-freelancers-portfolios--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-freelancers-portfolios--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-freelancers-portfolios--id-" data-method="GET"
      data-path="api/freelancers/portfolios/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-freelancers-portfolios--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-freelancers-portfolios--id-"
                    onclick="tryItOut('GETapi-freelancers-portfolios--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-freelancers-portfolios--id-"
                    onclick="cancelTryOut('GETapi-freelancers-portfolios--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-freelancers-portfolios--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/freelancers/portfolios/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-freelancers-portfolios--id-"
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
                              name="Accept"                data-endpoint="GETapi-freelancers-portfolios--id-"
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
                              name="Accept-Language"                data-endpoint="GETapi-freelancers-portfolios--id-"
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
               step="any"               name="id"                data-endpoint="GETapi-freelancers-portfolios--id-"
               value="1"
               data-component="url">
    <br>
<p>The portfolio ID. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="portfolio-management-PUTapi-freelancers-portfolios--id-">Update portfolio</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Update an existing portfolio. <strong>Important behavior notes:</strong></p>
<p><strong>For Attachments:</strong></p>
<ul>
<li>If you send <code>attachment_ids</code> parameter (even as empty array), ALL existing attachments will be detached and replaced with the new ones</li>
<li>If you don't send <code>attachment_ids</code> parameter at all, existing attachments will remain unchanged</li>
<li>You need to upload files first using /api/upload endpoint to get attachment IDs</li>
<li>Example: To change attachments, send new attachment IDs: <code>"attachment_ids": [20, 21, 22]</code></li>
</ul>
<p><strong>For Hashtags:</strong></p>
<ul>
<li>If you send <code>hashtags</code> parameter (even as empty array), ALL existing hashtags will be replaced with the new ones</li>
<li>If you don't send <code>hashtags</code> parameter at all, existing hashtags will remain unchanged</li>
<li>To remove all hashtags, send an empty array: <code>"hashtags": []</code></li>
</ul>

<span id="example-requests-PUTapi-freelancers-portfolios--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://backend.shuwier.com/api/freelancers/portfolios/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en" \
    --data "{
    \"title\": \"\\\"Updated E-commerce Website\\\"\",
    \"description\": \"\\\"An updated modern responsive e-commerce website\\\"\",
    \"category_id\": 1,
    \"subcategory_id\": 2,
    \"attachment_ids\": [
        20,
        21,
        22
    ],
    \"cover_id\": 20,
    \"hashtags\": [
        \"react\",
        \"updated\",
        \"laravel\"
    ]
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/freelancers/portfolios/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

let body = {
    "title": "\"Updated E-commerce Website\"",
    "description": "\"An updated modern responsive e-commerce website\"",
    "category_id": 1,
    "subcategory_id": 2,
    "attachment_ids": [
        20,
        21,
        22
    ],
    "cover_id": 20,
    "hashtags": [
        "react",
        "updated",
        "laravel"
    ]
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-freelancers-portfolios--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Portfolio updated successfully&quot;,
    &quot;status&quot;: true,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;title&quot;: &quot;Updated E-commerce Website&quot;,
        &quot;description&quot;: &quot;An updated modern responsive e-commerce website&quot;,
        &quot;category&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Web Development&quot;
        },
        &quot;subcategory&quot;: {
            &quot;id&quot;: 2,
            &quot;name&quot;: &quot;Frontend&quot;
        },
        &quot;hashtags&quot;: [
            &quot;#react&quot;,
            &quot;#updated&quot;
        ],
        &quot;attachments&quot;: [
            {
                &quot;id&quot;: 2,
                &quot;file_path&quot;: &quot;storage/portfolios/new_image.jpg&quot;
            }
        ]
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;This category is not a parent category&quot;,
    &quot;status&quot;: false,
    &quot;error_code&quot;: 400
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;This attachment is already used&quot;,
    &quot;status&quot;: false,
    &quot;error_code&quot;: 400
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;This attachment does not belong to the user&quot;,
    &quot;status&quot;: false,
    &quot;error_code&quot;: 400
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-freelancers-portfolios--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-freelancers-portfolios--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-freelancers-portfolios--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-freelancers-portfolios--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-freelancers-portfolios--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-freelancers-portfolios--id-" data-method="PUT"
      data-path="api/freelancers/portfolios/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-freelancers-portfolios--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-freelancers-portfolios--id-"
                    onclick="tryItOut('PUTapi-freelancers-portfolios--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-freelancers-portfolios--id-"
                    onclick="cancelTryOut('PUTapi-freelancers-portfolios--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-freelancers-portfolios--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/freelancers/portfolios/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/freelancers/portfolios/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-freelancers-portfolios--id-"
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
                              name="Accept"                data-endpoint="PUTapi-freelancers-portfolios--id-"
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
                              name="Accept-Language"                data-endpoint="PUTapi-freelancers-portfolios--id-"
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
               step="any"               name="id"                data-endpoint="PUTapi-freelancers-portfolios--id-"
               value="1"
               data-component="url">
    <br>
<p>The portfolio ID to update. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="PUTapi-freelancers-portfolios--id-"
               value=""Updated E-commerce Website""
               data-component="body">
    <br>
<p>The portfolio title (max 255 characters). Example: <code>"Updated E-commerce Website"</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="PUTapi-freelancers-portfolios--id-"
               value=""An updated modern responsive e-commerce website""
               data-component="body">
    <br>
<p>The portfolio description. Example: <code>"An updated modern responsive e-commerce website"</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>category_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="category_id"                data-endpoint="PUTapi-freelancers-portfolios--id-"
               value="1"
               data-component="body">
    <br>
<p>The main category ID (must be a parent category). Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>subcategory_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="subcategory_id"                data-endpoint="PUTapi-freelancers-portfolios--id-"
               value="2"
               data-component="body">
    <br>
<p>optional The subcategory ID (must belong to the selected category). Set to null to remove subcategory. Example: <code>2</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>attachment_ids</code></b>&nbsp;&nbsp;
<small>integer[]</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="attachment_ids[0]"                data-endpoint="PUTapi-freelancers-portfolios--id-"
               data-component="body">
        <input type="number" style="display: none"
               name="attachment_ids[1]"                data-endpoint="PUTapi-freelancers-portfolios--id-"
               data-component="body">
    <br>
<p>optional Array of attachment IDs from uploaded files (max 8 files). <strong>CAUTION:</strong> If provided, ALL existing attachments will be detached first.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>cover_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="cover_id"                data-endpoint="PUTapi-freelancers-portfolios--id-"
               value="20"
               data-component="body">
    <br>
<p>The attachment ID to set as the cover image. Example: <code>20</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>hashtags</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="hashtags[0]"                data-endpoint="PUTapi-freelancers-portfolios--id-"
               data-component="body">
        <input type="text" style="display: none"
               name="hashtags[1]"                data-endpoint="PUTapi-freelancers-portfolios--id-"
               data-component="body">
    <br>
<p>optional Array of hashtag strings. <strong>CAUTION:</strong> If provided, ALL existing hashtags will be replaced.</p>
        </div>
        </form>

                    <h2 id="portfolio-management-DELETEapi-freelancers-portfolios--id-">Delete portfolio</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Permanently delete a portfolio and all its associated data including attachments and hashtag relationships.
<strong>Warning:</strong> This action cannot be undone. All uploaded files will also be deleted from storage.</p>

<span id="example-requests-DELETEapi-freelancers-portfolios--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://backend.shuwier.com/api/freelancers/portfolios/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/freelancers/portfolios/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-freelancers-portfolios--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Portfolio deleted successfully&quot;,
    &quot;status&quot;: true,
    &quot;data&quot;: null
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Portfolio not found&quot;,
    &quot;status&quot;: false,
    &quot;error_code&quot;: 404
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-freelancers-portfolios--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-freelancers-portfolios--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-freelancers-portfolios--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-freelancers-portfolios--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-freelancers-portfolios--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-freelancers-portfolios--id-" data-method="DELETE"
      data-path="api/freelancers/portfolios/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-freelancers-portfolios--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-freelancers-portfolios--id-"
                    onclick="tryItOut('DELETEapi-freelancers-portfolios--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-freelancers-portfolios--id-"
                    onclick="cancelTryOut('DELETEapi-freelancers-portfolios--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-freelancers-portfolios--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/freelancers/portfolios/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-freelancers-portfolios--id-"
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
                              name="Accept"                data-endpoint="DELETEapi-freelancers-portfolios--id-"
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
                              name="Accept-Language"                data-endpoint="DELETEapi-freelancers-portfolios--id-"
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
               step="any"               name="id"                data-endpoint="DELETEapi-freelancers-portfolios--id-"
               value="1"
               data-component="url">
    <br>
<p>The portfolio ID to delete. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="public-home-page">Public Home Page</h1>

    

                                <h2 id="public-home-page-GETapi-home-guest">Guest home page</h2>

<p>
</p>

<p>Retrieve the homepage data for guest (non-authenticated) users. This endpoint provides
curated content including best-selling categories and top-performing services to showcase
the platform's offerings. This data helps visitors discover popular services and categories
without requiring authentication.</p>

<span id="example-requests-GETapi-home-guest">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://backend.shuwier.com/api/home/guest" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/home/guest"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-home-guest">
            <blockquote>
            <p>Example response (200, Home page data retrieved successfully):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Success&quot;,
    &quot;data&quot;: {
        &quot;best_seller_categories&quot;: [
            {
                &quot;id&quot;: 4,
                &quot;name&quot;: &quot;Programming&quot;,
                &quot;parent_id&quot;: null,
                &quot;created_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;
            },
            {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;Design &amp; Creative&quot;,
                &quot;parent_id&quot;: null,
                &quot;created_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;
            }
        ],
        &quot;best_seller_services&quot;: [
            {
                &quot;id&quot;: 4,
                &quot;title&quot;: &quot;WordPress Website Development&quot;,
                &quot;description&quot;: &quot;I will create a professional WordPress website with custom design and functionality tailored to your business needs with modern features and responsive design&quot;,
                &quot;category_id&quot;: 4,
                &quot;subcategory_id&quot;: 5,
                &quot;category&quot;: {
                    &quot;id&quot;: 4,
                    &quot;name&quot;: &quot;Programming&quot;,
                    &quot;parent_id&quot;: null,
                    &quot;created_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;
                },
                &quot;subcategory&quot;: {
                    &quot;id&quot;: 5,
                    &quot;name&quot;: &quot;Web&quot;,
                    &quot;parent_id&quot;: 4,
                    &quot;created_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;
                },
                &quot;delivery_time&quot;: 7,
                &quot;delivery_time_unit&quot;: &quot;days&quot;,
                &quot;service_fees_type&quot;: &quot;fixed&quot;,
                &quot;price&quot;: &quot;500.00&quot;,
                &quot;cover_photo&quot;: &quot;storage/services/68d3e4ae826cd.PNG&quot;,
                &quot;faqs&quot;: null,
                &quot;attachments&quot;: null,
                &quot;hashtags&quot;: null,
                &quot;user_id&quot;: 3,
                &quot;created_at&quot;: &quot;2025-09-24T12:31:42.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-24T12:31:42.000000Z&quot;
            },
            {
                &quot;id&quot;: 3,
                &quot;title&quot;: &quot;Mobile App Development&quot;,
                &quot;description&quot;: &quot;I will develop a custom mobile application for iOS and Android platforms using React Native with modern UI and seamless performance&quot;,
                &quot;category_id&quot;: 4,
                &quot;subcategory_id&quot;: 5,
                &quot;category&quot;: {
                    &quot;id&quot;: 4,
                    &quot;name&quot;: &quot;Programming&quot;,
                    &quot;parent_id&quot;: null,
                    &quot;created_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;
                },
                &quot;subcategory&quot;: {
                    &quot;id&quot;: 5,
                    &quot;name&quot;: &quot;Web&quot;,
                    &quot;parent_id&quot;: 4,
                    &quot;created_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;
                },
                &quot;delivery_time&quot;: 7,
                &quot;delivery_time_unit&quot;: &quot;days&quot;,
                &quot;service_fees_type&quot;: &quot;fixed&quot;,
                &quot;price&quot;: &quot;500.00&quot;,
                &quot;cover_photo&quot;: &quot;storage/services/68d3e46824cdc.PNG&quot;,
                &quot;faqs&quot;: null,
                &quot;attachments&quot;: null,
                &quot;hashtags&quot;: null,
                &quot;user_id&quot;: 3,
                &quot;created_at&quot;: &quot;2025-09-24T12:30:32.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-24T12:30:32.000000Z&quot;
            }
        ]
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Service unavailable):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;Unable to retrieve home page data&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-home-guest" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-home-guest"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-home-guest"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-home-guest" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-home-guest">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-home-guest" data-method="GET"
      data-path="api/home/guest"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-home-guest', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-home-guest"
                    onclick="tryItOut('GETapi-home-guest');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-home-guest"
                    onclick="cancelTryOut('GETapi-home-guest');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-home-guest"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/home/guest</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-home-guest"
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
                              name="Accept"                data-endpoint="GETapi-home-guest"
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
                              name="Accept-Language"                data-endpoint="GETapi-home-guest"
               value="en"
               data-component="header">
    <br>
<p>Example: <code>en</code></p>
            </div>
                        </form>

                    <h2 id="public-home-page-GETapi-home-freelancer">Freelancer Home Page</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retrieve personalized homepage data for authenticated freelancers. This endpoint provides
a curated list of available projects that match the freelancer's skills and interests.
Projects can be filtered by search terms, categories, and budget ranges to help freelancers
find relevant opportunities to bid on.</p>

<span id="example-requests-GETapi-home-freelancer">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://backend.shuwier.com/api/home/freelancer" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en" \
    --data "{
    \"search\": \"website development\",
    \"category_ids\": [
        4,
        2
    ],
    \"budgets\": [
        \"$100-$500\",
        \"$500-$1000\"
    ],
    \"per_page\": 15
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/home/freelancer"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

let body = {
    "search": "website development",
    "category_ids": [
        4,
        2
    ],
    "budgets": [
        "$100-$500",
        "$500-$1000"
    ],
    "per_page": 15
};

fetch(url, {
    method: "GET",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-home-freelancer">
            <blockquote>
            <p>Example response (200, Freelancer homepage data retrieved successfully):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
  &quot;status&quot;: true,
  &quot;error_num&quot;: null,
  &quot;message&quot;: &quot;Success&quot;,
  &quot;data&quot;: {
    &quot;current_page&quot;: 1,
    &quot;data&quot;: [
      {
        &quot;id&quot;: 5,
        &quot;title&quot;: &quot;E-commerce Website Development&quot;,
        &quot;description&quot;: &quot;I need a complete e-commerce website with product catalog, shopping cart, payment integration, and admin dashboard. The site should be responsive and SEO-optimized.&quot;,
        &quot;category_id&quot;: &quot;4&quot;,
        &quot;subcategory_id&quot;: &quot;5&quot;,
        &quot;budget&quot;: &quot;$1000-$2000&quot;,
        &quot;deadline_unit&quot;: &quot;days&quot;,
        &quot;deadline&quot;: &quot;12&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;comments_enabled&quot;: true,
        &quot;proposals_enabled&quot;: true,
        &quot;created_at&quot;: &quot;2025-10-06T09:11:11.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-10-06T09:11:11.000000Z&quot;,
        &quot;category&quot;: {
          &quot;id&quot;: 4,
          &quot;name&quot;: &quot;Programming&quot;,
          &quot;image&quot;: &quot;storage/categories/68dd364f26e71.svg&quot;,
          &quot;parent_id&quot;: null,
          &quot;created_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;,
          &quot;updated_at&quot;: &quot;2025-10-01T14:10:23.000000Z&quot;
        },
        &quot;subcategory&quot;: {
          &quot;id&quot;: 5,
          &quot;name&quot;: &quot;Web&quot;,
          &quot;image&quot;: null,
          &quot;parent_id&quot;: 4,
          &quot;created_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;,
          &quot;updated_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;
        },
        &quot;attachments&quot;: [
          {
            &quot;id&quot;: 2,
            &quot;file_path&quot;: &quot;storage/projects/68e3876bcc657.PNG&quot;,
            &quot;user_id&quot;: 2,
            &quot;project_id&quot;: 5,
            &quot;created_at&quot;: &quot;2025-10-06T09:10:03.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-10-06T09:11:11.000000Z&quot;
          }
        ],
        &quot;user&quot;: {
          &quot;id&quot;: 2,
          &quot;name&quot;: &quot;Ahmed test&quot;,
          &quot;email&quot;: &quot;freelancer2@gmail.com&quot;,
          &quot;type&quot;: &quot;client&quot;,
          &quot;is_active&quot;: true,
          &quot;profile_picture&quot;: &quot;storage/profiles/68d28083a3dd1.PNG&quot;,
          &quot;company&quot;: &quot;شركة التقنيات المتقدمة&quot;,
          &quot;country&quot;: &quot;asd&quot;,
          &quot;city&quot;: &quot;asd&quot;,
          &quot;is_verified&quot;: false,
          &quot;user_verification_status&quot;: &quot;approved&quot;,
          &quot;created_at&quot;: &quot;2025-09-03T11:34:36.000000Z&quot;,
          &quot;updated_at&quot;: &quot;2025-09-23T11:12:03.000000Z&quot;
        },
        &quot;proposals_count&quot;: 8,
        &quot;time_remaining&quot;: &quot;5 days left&quot;
      },
      {
        &quot;id&quot;: 7,
        &quot;title&quot;: &quot;Mobile App UI/UX Design&quot;,
        &quot;description&quot;: &quot;Looking for a talented designer to create modern and user-friendly UI/UX design for a fitness tracking mobile application.&quot;,
        &quot;category_id&quot;: &quot;2&quot;,
        &quot;subcategory_id&quot;: &quot;6&quot;,
        &quot;budget&quot;: &quot;$500-$800&quot;,
        &quot;deadline_unit&quot;: &quot;days&quot;,
        &quot;deadline&quot;: &quot;10&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;comments_enabled&quot;: true,
        &quot;proposals_enabled&quot;: true,
        &quot;created_at&quot;: &quot;2025-10-05T14:20:30.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-10-06T08:15:45.000000Z&quot;,
        &quot;category&quot;: {
          &quot;id&quot;: 2,
          &quot;name&quot;: &quot;Design &amp; Creative&quot;,
          &quot;image&quot;: &quot;storage/categories/68dd364f26e72.svg&quot;,
          &quot;parent_id&quot;: null,
          &quot;created_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;,
          &quot;updated_at&quot;: &quot;2025-10-01T14:10:23.000000Z&quot;
        },
        &quot;attachments&quot;: [],
        &quot;user&quot;: {
          &quot;id&quot;: 8,
          &quot;name&quot;: &quot;Sarah Johnson&quot;,
          &quot;email&quot;: &quot;sarah.client@example.com&quot;,
          &quot;type&quot;: &quot;client&quot;,
          &quot;is_active&quot;: true,
          &quot;profile_picture&quot;: &quot;storage/profiles/68d28083a3dd2.PNG&quot;,
          &quot;company&quot;: &quot;FitTech Solutions&quot;,
          &quot;country&quot;: &quot;USA&quot;,
          &quot;city&quot;: &quot;San Francisco&quot;,
          &quot;is_verified&quot;: true,
          &quot;user_verification_status&quot;: &quot;approved&quot;,
          &quot;created_at&quot;: &quot;2025-09-15T09:20:15.000000Z&quot;,
          &quot;updated_at&quot;: &quot;2025-10-01T16:45:30.000000Z&quot;
        },
      }
    ],
    &quot;first_page_url&quot;: &quot;http://localhost/api/freelancer/home?page=1&quot;,
    &quot;from&quot;: 1,
    &quot;last_page&quot;: 4,
    &quot;last_page_url&quot;: &quot;http://localhost/api/freelancer/home?page=4&quot;,
    &quot;links&quot;: [
      {
        &quot;url&quot;: null,
        &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
        &quot;active&quot;: false
      },
      {
        &quot;url&quot;: &quot;http://localhost/api/freelancer/home?page=1&quot;,
        &quot;label&quot;: &quot;1&quot;,
        &quot;active&quot;: true
      },
      {
        &quot;url&quot;: &quot;http://localhost/api/freelancer/home?page=2&quot;,
        &quot;label&quot;: &quot;2&quot;,
        &quot;active&quot;: false
      },
      {
        &quot;url&quot;: &quot;http://localhost/api/freelancer/home?page=2&quot;,
        &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
        &quot;active&quot;: false
      }
    ],
    &quot;next_page_url&quot;: &quot;http://localhost/api/freelancer/home?page=2&quot;,
    &quot;path&quot;: &quot;http://localhost/api/freelancer/home&quot;,
    &quot;per_page&quot;: 10,
    &quot;prev_page_url&quot;: null,
    &quot;to&quot;: 10,
    &quot;total&quot;: 35
  }
}</code>
 </pre>
            <blockquote>
            <p>Example response (200, No projects found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Success&quot;,
    &quot;data&quot;: {
        &quot;current_page&quot;: 1,
        &quot;data&quot;: [],
        &quot;first_page_url&quot;: &quot;http://localhost/api/freelancer/home?page=1&quot;,
        &quot;from&quot;: null,
        &quot;last_page&quot;: 1,
        &quot;last_page_url&quot;: &quot;http://localhost/api/freelancer/home?page=1&quot;,
        &quot;links&quot;: [
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost/api/freelancer/home?page=1&quot;,
                &quot;label&quot;: &quot;1&quot;,
                &quot;active&quot;: true
            },
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
                &quot;active&quot;: false
            }
        ],
        &quot;next_page_url&quot;: null,
        &quot;path&quot;: &quot;http://localhost/api/freelancer/home&quot;,
        &quot;per_page&quot;: 10,
        &quot;prev_page_url&quot;: null,
        &quot;to&quot;: null,
        &quot;total&quot;: 0
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Invalid parameters):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;Invalid filter parameters provided&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, Unauthenticated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 401,
    &quot;message&quot;: &quot;Unauthenticated&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-home-freelancer" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-home-freelancer"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-home-freelancer"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-home-freelancer" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-home-freelancer">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-home-freelancer" data-method="GET"
      data-path="api/home/freelancer"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-home-freelancer', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-home-freelancer"
                    onclick="tryItOut('GETapi-home-freelancer');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-home-freelancer"
                    onclick="cancelTryOut('GETapi-home-freelancer');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-home-freelancer"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/home/freelancer</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-home-freelancer"
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
                              name="Accept"                data-endpoint="GETapi-home-freelancer"
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
                              name="Accept-Language"                data-endpoint="GETapi-home-freelancer"
               value="en"
               data-component="header">
    <br>
<p>Example: <code>en</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>search</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="search"                data-endpoint="GETapi-home-freelancer"
               value="website development"
               data-component="body">
    <br>
<p>optional Search term to filter projects by title, description, or keywords. Example: <code>website development</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>category_ids</code></b>&nbsp;&nbsp;
<small>integer[]</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="category_ids[0]"                data-endpoint="GETapi-home-freelancer"
               data-component="body">
        <input type="number" style="display: none"
               name="category_ids[1]"                data-endpoint="GETapi-home-freelancer"
               data-component="body">
    <br>
<p>optional Array of category IDs to filter projects by specific categories.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>budgets</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="budgets[0]"                data-endpoint="GETapi-home-freelancer"
               data-component="body">
        <input type="text" style="display: none"
               name="budgets[1]"                data-endpoint="GETapi-home-freelancer"
               data-component="body">
    <br>
<p>optional Array of budget ranges to filter projects.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-home-freelancer"
               value="15"
               data-component="body">
    <br>
<p>optional Number of projects per page (default: 10). Example: <code>15</code></p>
        </div>
        </form>

                    <h2 id="public-home-page-GETapi-home-client">Client homepage</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retrieve personalized dashboard data for authenticated clients. This endpoint provides
an overview of the client's posted projects, active proposals, and platform statistics
relevant to their hiring needs. The dashboard helps clients manage their projects
and track the progress of their hiring activities.</p>

<span id="example-requests-GETapi-home-client">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://backend.shuwier.com/api/home/client" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/home/client"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-home-client">
            <blockquote>
            <p>Example response (200, Client dashboard data retrieved successfully):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Success&quot;,
    &quot;data&quot;: {
        &quot;projects_overview&quot;: {
            &quot;total_projects&quot;: 12,
            &quot;active_projects&quot;: 5,
            &quot;completed_projects&quot;: 6,
            &quot;pending_projects&quot;: 1,
            &quot;total_proposals_received&quot;: 84
        },
        &quot;recent_projects&quot;: [
            {
                &quot;id&quot;: 15,
                &quot;title&quot;: &quot;Mobile App Development&quot;,
                &quot;budget&quot;: &quot;$2000-$3000&quot;,
                &quot;status&quot;: &quot;active&quot;,
                &quot;proposals_count&quot;: 12,
                &quot;deadline&quot;: &quot;15 days&quot;,
                &quot;created_at&quot;: &quot;2025-10-06T10:30:00.000000Z&quot;,
                &quot;category&quot;: {
                    &quot;id&quot;: 4,
                    &quot;name&quot;: &quot;Programming&quot;
                }
            },
            {
                &quot;id&quot;: 14,
                &quot;title&quot;: &quot;Logo Design for Startup&quot;,
                &quot;budget&quot;: &quot;$200-$400&quot;,
                &quot;status&quot;: &quot;completed&quot;,
                &quot;proposals_count&quot;: 8,
                &quot;deadline&quot;: &quot;completed&quot;,
                &quot;created_at&quot;: &quot;2025-09-28T14:20:00.000000Z&quot;,
                &quot;category&quot;: {
                    &quot;id&quot;: 2,
                    &quot;name&quot;: &quot;Design &amp; Creative&quot;
                }
            }
        ],
        &quot;recent_proposals&quot;: [
            {
                &quot;id&quot;: 45,
                &quot;project_id&quot;: 15,
                &quot;project_title&quot;: &quot;Mobile App Development&quot;,
                &quot;freelancer&quot;: {
                    &quot;id&quot;: 7,
                    &quot;name&quot;: &quot;Mohammad Ali&quot;,
                    &quot;profile_picture&quot;: &quot;storage/profiles/68d28083a3dd3.PNG&quot;,
                    &quot;rating&quot;: 4.8,
                    &quot;completed_projects&quot;: 23
                },
                &quot;proposal_amount&quot;: &quot;$2500&quot;,
                &quot;delivery_time&quot;: &quot;20 days&quot;,
                &quot;status&quot;: &quot;pending&quot;,
                &quot;submitted_at&quot;: &quot;2025-10-06T12:15:00.000000Z&quot;
            },
            {
                &quot;id&quot;: 44,
                &quot;project_id&quot;: 15,
                &quot;project_title&quot;: &quot;Mobile App Development&quot;,
                &quot;freelancer&quot;: {
                    &quot;id&quot;: 9,
                    &quot;name&quot;: &quot;Fatima Hassan&quot;,
                    &quot;profile_picture&quot;: &quot;storage/profiles/68d28083a3dd4.PNG&quot;,
                    &quot;rating&quot;: 4.9,
                    &quot;completed_projects&quot;: 31
                },
                &quot;proposal_amount&quot;: &quot;$2800&quot;,
                &quot;delivery_time&quot;: &quot;18 days&quot;,
                &quot;status&quot;: &quot;pending&quot;,
                &quot;submitted_at&quot;: &quot;2025-10-06T11:45:00.000000Z&quot;
            }
        ],
        &quot;platform_stats&quot;: {
            &quot;total_freelancers&quot;: 1250,
            &quot;active_freelancers&quot;: 892,
            &quot;average_project_completion_time&quot;: &quot;12 days&quot;,
            &quot;client_satisfaction_rate&quot;: &quot;96%&quot;
        },
        &quot;recommended_categories&quot;: [
            {
                &quot;id&quot;: 4,
                &quot;name&quot;: &quot;Programming&quot;,
                &quot;image&quot;: &quot;storage/categories/68dd364f26e71.svg&quot;,
                &quot;projects_count&quot;: 234,
                &quot;avg_budget&quot;: &quot;$1200&quot;
            },
            {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;Design &amp; Creative&quot;,
                &quot;image&quot;: &quot;storage/categories/68dd364f26e72.svg&quot;,
                &quot;projects_count&quot;: 189,
                &quot;avg_budget&quot;: &quot;$450&quot;
            }
        ]
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (200, New client with no projects):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Success&quot;,
    &quot;data&quot;: {
        &quot;projects_overview&quot;: {
            &quot;total_projects&quot;: 0,
            &quot;active_projects&quot;: 0,
            &quot;completed_projects&quot;: 0,
            &quot;pending_projects&quot;: 0,
            &quot;total_proposals_received&quot;: 0
        },
        &quot;recent_projects&quot;: [],
        &quot;recent_proposals&quot;: [],
        &quot;platform_stats&quot;: {
            &quot;total_freelancers&quot;: 1250,
            &quot;active_freelancers&quot;: 892,
            &quot;average_project_completion_time&quot;: &quot;12 days&quot;,
            &quot;client_satisfaction_rate&quot;: &quot;96%&quot;
        },
        &quot;recommended_categories&quot;: [
            {
                &quot;id&quot;: 4,
                &quot;name&quot;: &quot;Programming&quot;,
                &quot;image&quot;: &quot;storage/categories/68dd364f26e71.svg&quot;,
                &quot;projects_count&quot;: 234,
                &quot;avg_budget&quot;: &quot;$1200&quot;
            },
            {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;Design &amp; Creative&quot;,
                &quot;image&quot;: &quot;storage/categories/68dd364f26e72.svg&quot;,
                &quot;projects_count&quot;: 189,
                &quot;avg_budget&quot;: &quot;$450&quot;
            },
            {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Writing &amp; Translation&quot;,
                &quot;image&quot;: &quot;storage/categories/68dd364f26e73.svg&quot;,
                &quot;projects_count&quot;: 156,
                &quot;avg_budget&quot;: &quot;$280&quot;
            }
        ]
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, Unauthenticated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 401,
    &quot;message&quot;: &quot;Unauthenticated&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Access denied - not a client):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 403,
    &quot;message&quot;: &quot;Access denied. This endpoint is only available for clients.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-home-client" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-home-client"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-home-client"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-home-client" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-home-client">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-home-client" data-method="GET"
      data-path="api/home/client"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-home-client', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-home-client"
                    onclick="tryItOut('GETapi-home-client');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-home-client"
                    onclick="cancelTryOut('GETapi-home-client');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-home-client"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/home/client</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-home-client"
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
                              name="Accept"                data-endpoint="GETapi-home-client"
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
                              name="Accept-Language"                data-endpoint="GETapi-home-client"
               value="en"
               data-component="header">
    <br>
<p>Example: <code>en</code></p>
            </div>
                        </form>

                <h1 id="public-search">Public Search</h1>

    

                                <h2 id="public-search-GETapi-search-service">Search services</h2>

<p>
</p>

<p>Search and filter services based on various criteria including text search, category,
subcategory, hashtags, and price range. This endpoint provides comprehensive service
discovery functionality with multiple filtering options. Results are paginated with
16 services per page.</p>

<span id="example-requests-GETapi-search-service">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://backend.shuwier.com/api/search/service" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en" \
    --data "{
    \"search\": \"wordpress website development\",
    \"category_id\": 4,
    \"subcategory_id\": 5,
    \"hashtag_ids\": [
        11,
        25,
        30
    ],
    \"price_min\": 100,
    \"price_max\": 1000
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/search/service"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

let body = {
    "search": "wordpress website development",
    "category_id": 4,
    "subcategory_id": 5,
    "hashtag_ids": [
        11,
        25,
        30
    ],
    "price_min": 100,
    "price_max": 1000
};

fetch(url, {
    method: "GET",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-search-service">
            <blockquote>
            <p>Example response (200, Services found successfully):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Success&quot;,
    &quot;data&quot;: {
        &quot;current_page&quot;: 1,
        &quot;data&quot;: [
            {
                &quot;id&quot;: 4,
                &quot;title&quot;: &quot;WordPress Website Development&quot;,
                &quot;description&quot;: &quot;I will create a professional WordPress website with custom design and functionality tailored to your business needs&quot;,
                &quot;category_id&quot;: 4,
                &quot;subcategory_id&quot;: 5,
                &quot;category&quot;: {
                    &quot;id&quot;: 4,
                    &quot;name&quot;: &quot;Programming&quot;,
                    &quot;parent_id&quot;: null,
                    &quot;created_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;
                },
                &quot;subcategory&quot;: {
                    &quot;id&quot;: 5,
                    &quot;name&quot;: &quot;Web&quot;,
                    &quot;parent_id&quot;: 4,
                    &quot;created_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;
                },
                &quot;delivery_time&quot;: 7,
                &quot;delivery_time_unit&quot;: &quot;days&quot;,
                &quot;service_fees_type&quot;: &quot;fixed&quot;,
                &quot;price&quot;: &quot;500.00&quot;,
                &quot;cover_photo&quot;: &quot;storage/services/68d3e4ae826cd.PNG&quot;,
                &quot;faqs&quot;: null,
                &quot;attachments&quot;: null,
                &quot;hashtags&quot;: null,
                &quot;user_id&quot;: 3,
                &quot;created_at&quot;: &quot;2025-09-24T12:31:42.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-24T12:31:42.000000Z&quot;
            },
            {
                &quot;id&quot;: 8,
                &quot;title&quot;: &quot;E-commerce Website Development&quot;,
                &quot;description&quot;: &quot;I will build a complete e-commerce website with payment integration, product management, and admin dashboard&quot;,
                &quot;category_id&quot;: 4,
                &quot;subcategory_id&quot;: 5,
                &quot;category&quot;: {
                    &quot;id&quot;: 4,
                    &quot;name&quot;: &quot;Programming&quot;,
                    &quot;parent_id&quot;: null,
                    &quot;created_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;
                },
                &quot;subcategory&quot;: {
                    &quot;id&quot;: 5,
                    &quot;name&quot;: &quot;Web&quot;,
                    &quot;parent_id&quot;: 4,
                    &quot;created_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;
                },
                &quot;delivery_time&quot;: 14,
                &quot;delivery_time_unit&quot;: &quot;days&quot;,
                &quot;service_fees_type&quot;: &quot;fixed&quot;,
                &quot;price&quot;: &quot;750.00&quot;,
                &quot;cover_photo&quot;: &quot;storage/services/68d3e4ae826ce.PNG&quot;,
                &quot;faqs&quot;: null,
                &quot;attachments&quot;: null,
                &quot;hashtags&quot;: null,
                &quot;user_id&quot;: 5,
                &quot;created_at&quot;: &quot;2025-09-25T09:15:30.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-25T09:15:30.000000Z&quot;
            }
        ],
        &quot;first_page_url&quot;: &quot;http://localhost/api/search/services?page=1&quot;,
        &quot;from&quot;: 1,
        &quot;last_page&quot;: 3,
        &quot;last_page_url&quot;: &quot;http://localhost/api/search/services?page=3&quot;,
        &quot;links&quot;: [
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost/api/search/services?page=1&quot;,
                &quot;label&quot;: &quot;1&quot;,
                &quot;active&quot;: true
            },
            {
                &quot;url&quot;: &quot;http://localhost/api/search/services?page=2&quot;,
                &quot;label&quot;: &quot;2&quot;,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost/api/search/services?page=3&quot;,
                &quot;label&quot;: &quot;3&quot;,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost/api/search/services?page=2&quot;,
                &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
                &quot;active&quot;: false
            }
        ],
        &quot;next_page_url&quot;: &quot;http://localhost/api/search/services?page=2&quot;,
        &quot;path&quot;: &quot;http://localhost/api/search/services&quot;,
        &quot;per_page&quot;: 16,
        &quot;prev_page_url&quot;: null,
        &quot;to&quot;: 16,
        &quot;total&quot;: 45
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (200, No services found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Success&quot;,
    &quot;data&quot;: {
        &quot;current_page&quot;: 1,
        &quot;data&quot;: [],
        &quot;first_page_url&quot;: &quot;http://localhost/api/search/services?page=1&quot;,
        &quot;from&quot;: null,
        &quot;last_page&quot;: 1,
        &quot;last_page_url&quot;: &quot;http://localhost/api/search/services?page=1&quot;,
        &quot;links&quot;: [
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost/api/search/services?page=1&quot;,
                &quot;label&quot;: &quot;1&quot;,
                &quot;active&quot;: true
            },
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
                &quot;active&quot;: false
            }
        ],
        &quot;next_page_url&quot;: null,
        &quot;path&quot;: &quot;http://localhost/api/search/services&quot;,
        &quot;per_page&quot;: 16,
        &quot;prev_page_url&quot;: null,
        &quot;to&quot;: null,
        &quot;total&quot;: 0
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Invalid category):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The selected category id is invalid.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Invalid subcategory):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The selected subcategory id is invalid.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Invalid hashtag):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The selected hashtag_ids.0 is invalid.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Invalid price range):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The price min field must be at least 0.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Search term too long):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The search field must not be greater than 5000 characters.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-search-service" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-search-service"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-search-service"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-search-service" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-search-service">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-search-service" data-method="GET"
      data-path="api/search/service"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-search-service', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-search-service"
                    onclick="tryItOut('GETapi-search-service');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-search-service"
                    onclick="cancelTryOut('GETapi-search-service');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-search-service"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/search/service</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-search-service"
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
                              name="Accept"                data-endpoint="GETapi-search-service"
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
                              name="Accept-Language"                data-endpoint="GETapi-search-service"
               value="en"
               data-component="header">
    <br>
<p>Example: <code>en</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>search</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="search"                data-endpoint="GETapi-search-service"
               value="wordpress website development"
               data-component="body">
    <br>
<p>optional Search term to find services by title, description, or keywords (max 5000 characters). Example: <code>wordpress website development</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>category_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="category_id"                data-endpoint="GETapi-search-service"
               value="4"
               data-component="body">
    <br>
<p>optional Filter services by main category ID. Must be a valid category. Example: <code>4</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>subcategory_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="subcategory_id"                data-endpoint="GETapi-search-service"
               value="5"
               data-component="body">
    <br>
<p>optional Filter services by subcategory ID. Must be a valid subcategory. Example: <code>5</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>hashtag_ids</code></b>&nbsp;&nbsp;
<small>integer[]</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="hashtag_ids[0]"                data-endpoint="GETapi-search-service"
               data-component="body">
        <input type="number" style="display: none"
               name="hashtag_ids[1]"                data-endpoint="GETapi-search-service"
               data-component="body">
    <br>
<p>optional Array of hashtag IDs to filter services. Services matching any hashtag will be returned.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>price_min</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="price_min"                data-endpoint="GETapi-search-service"
               value="100"
               data-component="body">
    <br>
<p>optional Minimum price filter. Only services with price &gt;= this value will be returned. Example: <code>100</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>price_max</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="price_max"                data-endpoint="GETapi-search-service"
               value="1000"
               data-component="body">
    <br>
<p>optional Maximum price filter. Only services with price &lt;= this value will be returned. Example: <code>1000</code></p>
        </div>
        </form>

                <h1 id="service-management">Service Management</h1>

    <p>APIs for managing freelancer services - creating, listing, updating and managing service offerings</p>

                                <h2 id="service-management-GETapi-freelancers-services">Get freelancer services</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retrieve all services created by the authenticated freelancer with pagination.
This endpoint returns a paginated list of the freelancer's service offerings including
title, description, pricing, delivery time, and other service details.</p>

<span id="example-requests-GETapi-freelancers-services">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://backend.shuwier.com/api/freelancers/services?per_page=15" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en" \
    --data "{
    \"per_page\": 73
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/freelancers/services"
);

const params = {
    "per_page": "15",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

let body = {
    "per_page": 73
};

fetch(url, {
    method: "GET",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-freelancers-services">
            <blockquote>
            <p>Example response (200, Services retrieved successfully):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Success&quot;,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;title&quot;: &quot;WordPress Website Development&quot;,
            &quot;description&quot;: &quot;I will create a professional WordPress website with custom design and functionality&quot;,
            &quot;category_id&quot;: 4,
            &quot;subcategory_id&quot;: 5,
            &quot;delivery_time&quot;: 7,
            &quot;delivery_time_unit&quot;: &quot;days&quot;,
            &quot;service_fees_type&quot;: &quot;fixed&quot;,
            &quot;price&quot;: &quot;500.00&quot;,
            &quot;cover_photo&quot;: &quot;storage/services/68d3dfbf590a6.PNG&quot;,
            &quot;faqs&quot;: [
                {
                    &quot;id&quot;: 1,
                    &quot;question&quot;: &quot;Do you provide hosting?&quot;,
                    &quot;answer&quot;: &quot;No, you need to provide your own hosting.&quot;,
                    &quot;service_id&quot;: 1,
                    &quot;created_at&quot;: &quot;2025-09-24T12:10:39.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-24T12:10:39.000000Z&quot;
                }
            ],
            &quot;attachments&quot;: [
                {
                    &quot;id&quot;: 1,
                    &quot;file_path&quot;: &quot;storage/services/68d3df744e841.PNG&quot;,
                    &quot;user_id&quot;: 3,
                    &quot;service_id&quot;: 1,
                    &quot;created_at&quot;: &quot;2025-09-24T12:09:24.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-24T12:10:39.000000Z&quot;
                }
            ],
            &quot;hashtags&quot;: [
                {
                    &quot;id&quot;: 11,
                    &quot;name&quot;: &quot;wordpress&quot;,
                    &quot;created_at&quot;: &quot;2025-09-24T12:10:39.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2025-09-24T12:10:39.000000Z&quot;,
                    &quot;pivot&quot;: {
                        &quot;service_id&quot;: 1,
                        &quot;hashtag_id&quot;: 11
                    }
                }
            ],
            &quot;user_id&quot;: 3,
            &quot;created_at&quot;: &quot;2025-09-24T12:10:39.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-24T12:10:39.000000Z&quot;
        }
    ],
    &quot;current_page&quot;: 1,
    &quot;from&quot;: 1,
    &quot;last_page&quot;: 1,
    &quot;per_page&quot;: 10,
    &quot;to&quot;: 4,
    &quot;total&quot;: 4,
    &quot;links&quot;: {
        &quot;first&quot;: &quot;http://127.0.0.1:8000/api/freelancers/services?page=1&quot;,
        &quot;last&quot;: &quot;http://127.0.0.1:8000/api/freelancers/services?page=1&quot;,
        &quot;prev&quot;: null,
        &quot;next&quot;: null
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (200, No services found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Success&quot;,
    &quot;data&quot;: [],
    &quot;current_page&quot;: 1,
    &quot;from&quot;: null,
    &quot;last_page&quot;: 1,
    &quot;per_page&quot;: 10,
    &quot;to&quot;: null,
    &quot;total&quot;: 0,
    &quot;links&quot;: {
        &quot;first&quot;: &quot;http://127.0.0.1:8000/api/freelancers/services?page=1&quot;,
        &quot;last&quot;: &quot;http://127.0.0.1:8000/api/freelancers/services?page=1&quot;,
        &quot;prev&quot;: null,
        &quot;next&quot;: null
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Invalid per_page parameter):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The per page must be at least 1.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, Unauthenticated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 401,
    &quot;message&quot;: &quot;Unauthenticated&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-freelancers-services" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-freelancers-services"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-freelancers-services"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-freelancers-services" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-freelancers-services">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-freelancers-services" data-method="GET"
      data-path="api/freelancers/services"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-freelancers-services', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-freelancers-services"
                    onclick="tryItOut('GETapi-freelancers-services');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-freelancers-services"
                    onclick="cancelTryOut('GETapi-freelancers-services');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-freelancers-services"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/freelancers/services</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-freelancers-services"
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
                              name="Accept"                data-endpoint="GETapi-freelancers-services"
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
                              name="Accept-Language"                data-endpoint="GETapi-freelancers-services"
               value="en"
               data-component="header">
    <br>
<p>Example: <code>en</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-freelancers-services"
               value="15"
               data-component="query">
    <br>
<p>Number of services per page (minimum 1). Default is 10. Example: <code>15</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-freelancers-services"
               value="73"
               data-component="body">
    <br>
<p>Must be at least 1. Example: <code>73</code></p>
        </div>
        </form>

                    <h2 id="service-management-POSTapi-freelancers-services">Create new service</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Create a new service offering for the authenticated freelancer. This endpoint allows
freelancers to add new services to their profile with detailed information including
pricing, delivery time, cover photo, attachments, FAQs, and hashtags.</p>

<span id="example-requests-POSTapi-freelancers-services">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://backend.shuwier.com/api/freelancers/services" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --header "Accept-Language: en" \
    --form "title=WordPress Website Development"\
    --form "description=I will create a professional WordPress website with custom design and functionality"\
    --form "category_id=1"\
    --form "subcategory_id=4"\
    --form "delivery_time_unit=days"\
    --form "delivery_time=7"\
    --form "fees_type=fixed"\
    --form "price=500"\
    --form "hashtags[]=wordpress"\
    --form "attachment_ids[]=15"\
    --form "faqs[][question]=amniihfqcoynlazghdtqt"\
    --form "faqs[][answer]=qxbajwbpilpmufinllwlo"\
    --form "cover_photo=@/private/var/folders/bh/ymm81xv929z74_28m5_265d40000gn/T/phpoP7vXI" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/freelancers/services"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
    "Accept-Language": "en",
};

const body = new FormData();
body.append('title', 'WordPress Website Development');
body.append('description', 'I will create a professional WordPress website with custom design and functionality');
body.append('category_id', '1');
body.append('subcategory_id', '4');
body.append('delivery_time_unit', 'days');
body.append('delivery_time', '7');
body.append('fees_type', 'fixed');
body.append('price', '500');
body.append('hashtags[]', 'wordpress');
body.append('attachment_ids[]', '15');
body.append('faqs[][question]', 'amniihfqcoynlazghdtqt');
body.append('faqs[][answer]', 'qxbajwbpilpmufinllwlo');
body.append('cover_photo', document.querySelector('input[name="cover_photo"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-freelancers-services">
            <blockquote>
            <p>Example response (200, Service created successfully):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Service created successfully&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 29,
        &quot;title&quot;: &quot;WordPress Website Development&quot;,
        &quot;description&quot;: &quot;I will create a professional WordPress website with custom design and functionality&quot;,
        &quot;category_id&quot;: 4,
        &quot;subcategory_id&quot;: 5,
        &quot;category&quot;: {
            &quot;id&quot;: 4,
            &quot;name&quot;: &quot;Programming&quot;,
            &quot;parent_id&quot;: null,
            &quot;created_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;
        },
        &quot;subcategory&quot;: {
            &quot;id&quot;: 5,
            &quot;name&quot;: &quot;Web&quot;,
            &quot;parent_id&quot;: 4,
            &quot;created_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;
        },
        &quot;delivery_time&quot;: 7,
        &quot;delivery_time_unit&quot;: &quot;days&quot;,
        &quot;service_fees_type&quot;: &quot;fixed&quot;,
        &quot;price&quot;: &quot;500.00&quot;,
        &quot;cover_photo&quot;: &quot;storage/services/68d3dfbf590a6.PNG&quot;,
        &quot;faqs&quot;: [
            {
                &quot;id&quot;: 15,
                &quot;question&quot;: &quot;Do you provide hosting?&quot;,
                &quot;answer&quot;: &quot;No, you need to provide your own hosting.&quot;,
                &quot;service_id&quot;: 29,
                &quot;created_at&quot;: &quot;2025-09-24T10:00:00.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-24T10:00:00.000000Z&quot;
            }
        ],
        &quot;attachments&quot;: [
            {
                &quot;id&quot;: 15,
                &quot;file_path&quot;: &quot;storage/services/68d3df744e841.PNG&quot;,
                &quot;user_id&quot;: 3,
                &quot;service_id&quot;: 29,
                &quot;created_at&quot;: &quot;2025-09-24T10:00:00.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-24T10:00:00.000000Z&quot;
            }
        ],
        &quot;hashtags&quot;: [
            {
                &quot;id&quot;: 11,
                &quot;name&quot;: &quot;wordpress&quot;,
                &quot;created_at&quot;: &quot;2025-09-24T10:00:00.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-24T10:00:00.000000Z&quot;,
                &quot;pivot&quot;: {
                    &quot;service_id&quot;: 29,
                    &quot;hashtag_id&quot;: 11
                }
            }
        ],
        &quot;user_id&quot;: 3,
        &quot;created_at&quot;: &quot;2025-09-24T10:00:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-24T10:00:00.000000Z&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Invalid category):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;This category is not a parent category&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Invalid subcategory):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;This subcategory does not belong to the selected category&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Validation error):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The title field is required.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, Unauthenticated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 401,
    &quot;message&quot;: &quot;Unauthenticated&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-freelancers-services" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-freelancers-services"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-freelancers-services"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-freelancers-services" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-freelancers-services">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-freelancers-services" data-method="POST"
      data-path="api/freelancers/services"
      data-authed="1"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-freelancers-services', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-freelancers-services"
                    onclick="tryItOut('POSTapi-freelancers-services');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-freelancers-services"
                    onclick="cancelTryOut('POSTapi-freelancers-services');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-freelancers-services"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/freelancers/services</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-freelancers-services"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-freelancers-services"
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
                              name="Accept-Language"                data-endpoint="POSTapi-freelancers-services"
               value="en"
               data-component="header">
    <br>
<p>Example: <code>en</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="POSTapi-freelancers-services"
               value="WordPress Website Development"
               data-component="body">
    <br>
<p>Service title (max 255 characters). Example: <code>WordPress Website Development</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="POSTapi-freelancers-services"
               value="I will create a professional WordPress website with custom design and functionality"
               data-component="body">
    <br>
<p>Detailed service description. Example: <code>I will create a professional WordPress website with custom design and functionality</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>category_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="category_id"                data-endpoint="POSTapi-freelancers-services"
               value="1"
               data-component="body">
    <br>
<p>Main category ID (must be a parent category). Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>subcategory_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="subcategory_id"                data-endpoint="POSTapi-freelancers-services"
               value="4"
               data-component="body">
    <br>
<p>optional Subcategory ID (must belong to the selected category). Example: <code>4</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>delivery_time_unit</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="delivery_time_unit"                data-endpoint="POSTapi-freelancers-services"
               value="days"
               data-component="body">
    <br>
<p>Time unit for delivery. Must be one of: hours, days, weeks. Example: <code>days</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>delivery_time</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="delivery_time"                data-endpoint="POSTapi-freelancers-services"
               value="7"
               data-component="body">
    <br>
<p>Delivery time in the specified unit. Example: <code>7</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>fees_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="fees_type"                data-endpoint="POSTapi-freelancers-services"
               value="fixed"
               data-component="body">
    <br>
<p>Pricing type. Must be one of: fixed, hourly. Example: <code>fixed</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>price</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="price"                data-endpoint="POSTapi-freelancers-services"
               value="500"
               data-component="body">
    <br>
<p>Service price (minimum 0). Example: <code>500</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>cover_photo</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="cover_photo"                data-endpoint="POSTapi-freelancers-services"
               value=""
               data-component="body">
    <br>
<p>Cover photo for the service (image file, max 2MB). Example: Example: <code>/private/var/folders/bh/ymm81xv929z74_28m5_265d40000gn/T/phpoP7vXI</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>hashtags</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="hashtags[0]"                data-endpoint="POSTapi-freelancers-services"
               data-component="body">
        <input type="text" style="display: none"
               name="hashtags[1]"                data-endpoint="POSTapi-freelancers-services"
               data-component="body">
    <br>
<p>optional Array of hashtag strings (max 255 characters each).</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>attachment_ids</code></b>&nbsp;&nbsp;
<small>integer[]</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="attachment_ids[0]"                data-endpoint="POSTapi-freelancers-services"
               data-component="body">
        <input type="number" style="display: none"
               name="attachment_ids[1]"                data-endpoint="POSTapi-freelancers-services"
               data-component="body">
    <br>
<p>optional Array of attachment IDs from uploaded files. Upload files first using /api/upload endpoint.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>faqs</code></b>&nbsp;&nbsp;
<small>object[]</small>&nbsp;
<i>optional</i> &nbsp;
<br>
<p>optional Array of FAQ objects with question and answer. Example:</p>
            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>question</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="faqs.0.question"                data-endpoint="POSTapi-freelancers-services"
               value="amniihfqcoynlazghdtqt"
               data-component="body">
    <br>
<p>This field is required when <code>faqs</code> is present. Must not be greater than 255 characters. Example: <code>amniihfqcoynlazghdtqt</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>answer</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="faqs.0.answer"                data-endpoint="POSTapi-freelancers-services"
               value="qxbajwbpilpmufinllwlo"
               data-component="body">
    <br>
<p>This field is required when <code>faqs</code> is present. Must not be greater than 1000 characters. Example: <code>qxbajwbpilpmufinllwlo</code></p>
                    </div>
                                                                <div style=" margin-left: 14px; clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>*</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
<br>

            </summary>
                                                <div style="margin-left: 28px; clear: unset;">
                        <b style="line-height: 2;"><code>question</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="faqs.*.question"                data-endpoint="POSTapi-freelancers-services"
               value="Do you provide hosting?"
               data-component="body">
    <br>
<p>required_with:faqs FAQ question (max 500 characters). Example: <code>Do you provide hosting?</code></p>
                    </div>
                                                                <div style="margin-left: 28px; clear: unset;">
                        <b style="line-height: 2;"><code>answer</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="faqs.*.answer"                data-endpoint="POSTapi-freelancers-services"
               value="No, you need to provide your own hosting."
               data-component="body">
    <br>
<p>required_with:faqs FAQ answer (max 1000 characters). Example: <code>No, you need to provide your own hosting.</code></p>
                    </div>
                                    </details>
        </div>
                                        </details>
        </div>
        </form>

                    <h2 id="service-management-GETapi-freelancers-services--id-">Get specific service</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retrieve detailed information about a specific service by its ID. This endpoint returns
comprehensive service details including all related data like category, subcategory,
attachments, FAQs, hashtags, and pricing information.</p>

<span id="example-requests-GETapi-freelancers-services--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://backend.shuwier.com/api/freelancers/services/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/freelancers/services/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-freelancers-services--id-">
            <blockquote>
            <p>Example response (200, Service retrieved successfully):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Success&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;title&quot;: &quot;WordPress Website Development&quot;,
        &quot;description&quot;: &quot;I will create a professional WordPress website with custom design and functionality tailored to your business needs&quot;,
        &quot;category_id&quot;: 4,
        &quot;subcategory_id&quot;: 5,
        &quot;category&quot;: {
            &quot;id&quot;: 4,
            &quot;name&quot;: &quot;Programming&quot;,
            &quot;parent_id&quot;: null,
            &quot;created_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;
        },
        &quot;subcategory&quot;: {
            &quot;id&quot;: 5,
            &quot;name&quot;: &quot;Web&quot;,
            &quot;parent_id&quot;: 4,
            &quot;created_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;
        },
        &quot;delivery_time&quot;: 7,
        &quot;delivery_time_unit&quot;: &quot;days&quot;,
        &quot;service_fees_type&quot;: &quot;fixed&quot;,
        &quot;price&quot;: &quot;500.00&quot;,
        &quot;cover_photo&quot;: &quot;storage/services/68d3dfbf590a6.PNG&quot;,
        &quot;faqs&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;question&quot;: &quot;Do you provide hosting?&quot;,
                &quot;answer&quot;: &quot;No, you need to provide your own hosting. However, I can recommend reliable hosting providers.&quot;,
                &quot;service_id&quot;: 1,
                &quot;created_at&quot;: &quot;2025-09-24T12:10:39.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-24T12:10:39.000000Z&quot;
            },
            {
                &quot;id&quot;: 2,
                &quot;question&quot;: &quot;How many revisions are included?&quot;,
                &quot;answer&quot;: &quot;I provide up to 3 revisions to ensure you&#039;re completely satisfied with the final result.&quot;,
                &quot;service_id&quot;: 1,
                &quot;created_at&quot;: &quot;2025-09-24T12:10:39.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-24T12:10:39.000000Z&quot;
            }
        ],
        &quot;attachments&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;file_path&quot;: &quot;storage/services/68d3df744e841.PNG&quot;,
                &quot;user_id&quot;: 3,
                &quot;service_id&quot;: 1,
                &quot;created_at&quot;: &quot;2025-09-24T12:09:24.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-24T12:10:39.000000Z&quot;
            }
        ],
        &quot;hashtags&quot;: [
            {
                &quot;id&quot;: 11,
                &quot;name&quot;: &quot;wordpress&quot;,
                &quot;created_at&quot;: &quot;2025-09-24T12:10:39.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-24T12:10:39.000000Z&quot;,
                &quot;pivot&quot;: {
                    &quot;service_id&quot;: 1,
                    &quot;hashtag_id&quot;: 11
                }
            }
        ],
        &quot;user_id&quot;: 3,
        &quot;created_at&quot;: &quot;2025-09-24T12:10:39.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-24T12:10:39.000000Z&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Service not found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;Service not found&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, Unauthenticated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 401,
    &quot;message&quot;: &quot;Unauthenticated&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Access denied - Not your service):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 403,
    &quot;message&quot;: &quot;You don&#039;t have permission to access this service&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-freelancers-services--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-freelancers-services--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-freelancers-services--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-freelancers-services--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-freelancers-services--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-freelancers-services--id-" data-method="GET"
      data-path="api/freelancers/services/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-freelancers-services--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-freelancers-services--id-"
                    onclick="tryItOut('GETapi-freelancers-services--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-freelancers-services--id-"
                    onclick="cancelTryOut('GETapi-freelancers-services--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-freelancers-services--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/freelancers/services/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-freelancers-services--id-"
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
                              name="Accept"                data-endpoint="GETapi-freelancers-services--id-"
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
                              name="Accept-Language"                data-endpoint="GETapi-freelancers-services--id-"
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
               step="any"               name="id"                data-endpoint="GETapi-freelancers-services--id-"
               value="1"
               data-component="url">
    <br>
<p>The service ID to retrieve. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="service-management-PUTapi-freelancers-services--id-">Update service</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Update an existing service offering for the authenticated freelancer. This endpoint allows
freelancers to modify their service information including pricing, delivery time, cover photo,
attachments, FAQs, and hashtags. All fields are optional except the service ID in the URL.</p>

<span id="example-requests-PUTapi-freelancers-services--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://backend.shuwier.com/api/freelancers/services/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en" \
    --data "{
    \"title\": \"Updated WordPress Website Development\",
    \"description\": \"I will create a professional WordPress website with advanced features and custom functionality\",
    \"category_id\": 4,
    \"subcategory_id\": 5,
    \"delivery_time_unit\": \"days\",
    \"delivery_time\": 10,
    \"fees_type\": \"fixed\",
    \"price\": 750,
    \"hashtags\": [
        \"wordpress\",
        \"website\",
        \"ecommerce\",
        \"responsive\"
    ],
    \"attachment_ids\": [
        18,
        19,
        20
    ],
    \"faqs\": [
        {
            \"question\": \"amniihfqcoynlazghdtqt\",
            \"answer\": \"qxbajwbpilpmufinllwlo\"
        }
    ]
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/freelancers/services/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

let body = {
    "title": "Updated WordPress Website Development",
    "description": "I will create a professional WordPress website with advanced features and custom functionality",
    "category_id": 4,
    "subcategory_id": 5,
    "delivery_time_unit": "days",
    "delivery_time": 10,
    "fees_type": "fixed",
    "price": 750,
    "hashtags": [
        "wordpress",
        "website",
        "ecommerce",
        "responsive"
    ],
    "attachment_ids": [
        18,
        19,
        20
    ],
    "faqs": [
        {
            "question": "amniihfqcoynlazghdtqt",
            "answer": "qxbajwbpilpmufinllwlo"
        }
    ]
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-freelancers-services--id-">
            <blockquote>
            <p>Example response (200, Service updated successfully):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Service updated successfully&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;title&quot;: &quot;Updated WordPress Website Development&quot;,
        &quot;description&quot;: &quot;I will create a professional WordPress website with advanced features and custom functionality tailored to your business needs&quot;,
        &quot;category_id&quot;: 4,
        &quot;subcategory_id&quot;: 5,
        &quot;category&quot;: {
            &quot;id&quot;: 4,
            &quot;name&quot;: &quot;Programming&quot;,
            &quot;parent_id&quot;: null,
            &quot;created_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;
        },
        &quot;subcategory&quot;: {
            &quot;id&quot;: 5,
            &quot;name&quot;: &quot;Web&quot;,
            &quot;parent_id&quot;: 4,
            &quot;created_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-09-07T08:44:46.000000Z&quot;
        },
        &quot;delivery_time&quot;: 10,
        &quot;delivery_time_unit&quot;: &quot;days&quot;,
        &quot;service_fees_type&quot;: &quot;fixed&quot;,
        &quot;price&quot;: &quot;750.00&quot;,
        &quot;cover_photo&quot;: &quot;storage/services/68d3dfbf590a6.PNG&quot;,
        &quot;faqs&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;question&quot;: &quot;Do you provide SSL certificates?&quot;,
                &quot;answer&quot;: &quot;Yes, I can help you install SSL certificates for enhanced security.&quot;,
                &quot;service_id&quot;: 1,
                &quot;created_at&quot;: &quot;2025-09-24T15:30:00.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-24T15:30:00.000000Z&quot;
            }
        ],
        &quot;attachments&quot;: [
            {
                &quot;id&quot;: 18,
                &quot;file_path&quot;: &quot;storage/services/68d3df744e841.PNG&quot;,
                &quot;user_id&quot;: 3,
                &quot;service_id&quot;: 1,
                &quot;created_at&quot;: &quot;2025-09-24T15:30:00.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-24T15:30:00.000000Z&quot;
            }
        ],
        &quot;hashtags&quot;: [
            {
                &quot;id&quot;: 11,
                &quot;name&quot;: &quot;wordpress&quot;,
                &quot;created_at&quot;: &quot;2025-09-24T15:30:00.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-09-24T15:30:00.000000Z&quot;,
                &quot;pivot&quot;: {
                    &quot;service_id&quot;: 1,
                    &quot;hashtag_id&quot;: 11
                }
            }
        ],
        &quot;user_id&quot;: 3,
        &quot;created_at&quot;: &quot;2025-09-24T12:10:39.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-09-24T15:30:00.000000Z&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Invalid category):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;This category is not a parent category&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Invalid subcategory):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;This subcategory does not belong to the selected category&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Attachment already used):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;This attachment is already used&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Validation error):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The title field must not be greater than 255 characters.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, Unauthenticated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 401,
    &quot;message&quot;: &quot;Unauthenticated&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, Service not found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 404,
    &quot;message&quot;: &quot;Service not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-freelancers-services--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-freelancers-services--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-freelancers-services--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-freelancers-services--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-freelancers-services--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-freelancers-services--id-" data-method="PUT"
      data-path="api/freelancers/services/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-freelancers-services--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-freelancers-services--id-"
                    onclick="tryItOut('PUTapi-freelancers-services--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-freelancers-services--id-"
                    onclick="cancelTryOut('PUTapi-freelancers-services--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-freelancers-services--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/freelancers/services/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/freelancers/services/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-freelancers-services--id-"
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
                              name="Accept"                data-endpoint="PUTapi-freelancers-services--id-"
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
                              name="Accept-Language"                data-endpoint="PUTapi-freelancers-services--id-"
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
               step="any"               name="id"                data-endpoint="PUTapi-freelancers-services--id-"
               value="1"
               data-component="url">
    <br>
<p>Service ID to update. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="PUTapi-freelancers-services--id-"
               value="Updated WordPress Website Development"
               data-component="body">
    <br>
<p>optional Service title (max 255 characters). Example: <code>Updated WordPress Website Development</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="PUTapi-freelancers-services--id-"
               value="I will create a professional WordPress website with advanced features and custom functionality"
               data-component="body">
    <br>
<p>optional Detailed service description (min 200 characters). Example: <code>I will create a professional WordPress website with advanced features and custom functionality</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>category_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="category_id"                data-endpoint="PUTapi-freelancers-services--id-"
               value="4"
               data-component="body">
    <br>
<p>optional Main category ID (must be a parent category). Example: <code>4</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>subcategory_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="subcategory_id"                data-endpoint="PUTapi-freelancers-services--id-"
               value="5"
               data-component="body">
    <br>
<p>optional Subcategory ID (must belong to the selected category). Example: <code>5</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>delivery_time_unit</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="delivery_time_unit"                data-endpoint="PUTapi-freelancers-services--id-"
               value="days"
               data-component="body">
    <br>
<p>optional Time unit for delivery. Must be one of: hours, days, weeks. Example: <code>days</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>delivery_time</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="delivery_time"                data-endpoint="PUTapi-freelancers-services--id-"
               value="10"
               data-component="body">
    <br>
<p>optional Delivery time in the specified unit. Example: <code>10</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>fees_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="fees_type"                data-endpoint="PUTapi-freelancers-services--id-"
               value="fixed"
               data-component="body">
    <br>
<p>optional Pricing type. Must be one of: fixed, hourly. Example: <code>fixed</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>price</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="price"                data-endpoint="PUTapi-freelancers-services--id-"
               value="750"
               data-component="body">
    <br>
<p>optional Service price (minimum 0). Example: <code>750</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>cover_photo</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="file" style="display: none"
                              name="cover_photo"                data-endpoint="PUTapi-freelancers-services--id-"
               value=""
               data-component="body">
    <br>
<p>optional New cover photo for the service (image file, max 2MB). Example:</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>hashtags</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="hashtags[0]"                data-endpoint="PUTapi-freelancers-services--id-"
               data-component="body">
        <input type="text" style="display: none"
               name="hashtags[1]"                data-endpoint="PUTapi-freelancers-services--id-"
               data-component="body">
    <br>
<p>optional Array of hashtag strings (max 255 characters each).</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>attachment_ids</code></b>&nbsp;&nbsp;
<small>integer[]</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="attachment_ids[0]"                data-endpoint="PUTapi-freelancers-services--id-"
               data-component="body">
        <input type="number" style="display: none"
               name="attachment_ids[1]"                data-endpoint="PUTapi-freelancers-services--id-"
               data-component="body">
    <br>
<p>optional Array of attachment IDs from uploaded files. Upload files first using /api/upload endpoint.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>faqs</code></b>&nbsp;&nbsp;
<small>object[]</small>&nbsp;
<i>optional</i> &nbsp;
<br>
<p>optional Array of FAQ objects with question and answer. Example:</p>
            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>question</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="faqs.0.question"                data-endpoint="PUTapi-freelancers-services--id-"
               value="amniihfqcoynlazghdtqt"
               data-component="body">
    <br>
<p>This field is required when <code>faqs</code> is present. Must not be greater than 255 characters. Example: <code>amniihfqcoynlazghdtqt</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>answer</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="faqs.0.answer"                data-endpoint="PUTapi-freelancers-services--id-"
               value="qxbajwbpilpmufinllwlo"
               data-component="body">
    <br>
<p>This field is required when <code>faqs</code> is present. Must not be greater than 1000 characters. Example: <code>qxbajwbpilpmufinllwlo</code></p>
                    </div>
                                                                <div style=" margin-left: 14px; clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>*</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
<br>

            </summary>
                                                <div style="margin-left: 28px; clear: unset;">
                        <b style="line-height: 2;"><code>question</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="faqs.*.question"                data-endpoint="PUTapi-freelancers-services--id-"
               value="Do you provide SSL certificates?"
               data-component="body">
    <br>
<p>required_with:faqs FAQ question (max 500 characters). Example: <code>Do you provide SSL certificates?</code></p>
                    </div>
                                                                <div style="margin-left: 28px; clear: unset;">
                        <b style="line-height: 2;"><code>answer</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="faqs.*.answer"                data-endpoint="PUTapi-freelancers-services--id-"
               value="Yes, I can help you install SSL certificates for enhanced security."
               data-component="body">
    <br>
<p>required_with:faqs FAQ answer (max 1000 characters). Example: <code>Yes, I can help you install SSL certificates for enhanced security.</code></p>
                    </div>
                                    </details>
        </div>
                                        </details>
        </div>
        </form>

                    <h2 id="service-management-DELETEapi-freelancers-services--id-">Delete service</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Delete an existing service offering for the authenticated freelancer. This endpoint
permanently removes the service and all associated data including FAQs, hashtag
associations, and attachment references. The service attachments files will also
be deleted from storage.</p>

<span id="example-requests-DELETEapi-freelancers-services--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://backend.shuwier.com/api/freelancers/services/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/freelancers/services/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-freelancers-services--id-">
            <blockquote>
            <p>Example response (200, Service deleted successfully):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Service deleted successfully&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, Unauthenticated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 401,
    &quot;message&quot;: &quot;Unauthenticated&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Unauthorized access):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 403,
    &quot;message&quot;: &quot;You are not authorized to delete this service&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, Service not found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 404,
    &quot;message&quot;: &quot;Service not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-freelancers-services--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-freelancers-services--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-freelancers-services--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-freelancers-services--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-freelancers-services--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-freelancers-services--id-" data-method="DELETE"
      data-path="api/freelancers/services/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-freelancers-services--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-freelancers-services--id-"
                    onclick="tryItOut('DELETEapi-freelancers-services--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-freelancers-services--id-"
                    onclick="cancelTryOut('DELETEapi-freelancers-services--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-freelancers-services--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/freelancers/services/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-freelancers-services--id-"
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
                              name="Accept"                data-endpoint="DELETEapi-freelancers-services--id-"
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
                              name="Accept-Language"                data-endpoint="DELETEapi-freelancers-services--id-"
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
               step="any"               name="id"                data-endpoint="DELETEapi-freelancers-services--id-"
               value="1"
               data-component="url">
    <br>
<p>Service ID to delete. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="skills">Skills</h1>

    <p>APIs for managing skills and retrieving skill data</p>

                                <h2 id="skills-GETapi-skills">Get all skills</h2>

<p>
</p>

<p>Retrieve all available skills in the system. Skills are used by freelancers
to indicate their expertise and by clients to find suitable freelancers.
Use this endpoint to populate skill selection lists in user profiles or search filters.</p>

<span id="example-requests-GETapi-skills">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://backend.shuwier.com/api/skills" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/skills"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-skills">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Success&quot;,
    &quot;status&quot;: true,
    &quot;data&quot;: {
        &quot;data&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;JavaScript&quot;
            },
            {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;React&quot;
            },
            {
                &quot;id&quot;: 3,
                &quot;name&quot;: &quot;Laravel&quot;
            },
            {
                &quot;id&quot;: 4,
                &quot;name&quot;: &quot;Adobe Photoshop&quot;
            },
            {
                &quot;id&quot;: 5,
                &quot;name&quot;: &quot;Node.js&quot;
            }
        ]
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;An error occurred while retrieving skills&quot;,
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-skills" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-skills"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-skills"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-skills" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-skills">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-skills" data-method="GET"
      data-path="api/skills"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-skills', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-skills"
                    onclick="tryItOut('GETapi-skills');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-skills"
                    onclick="cancelTryOut('GETapi-skills');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-skills"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/skills</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-skills"
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
                              name="Accept"                data-endpoint="GETapi-skills"
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
                              name="Accept-Language"                data-endpoint="GETapi-skills"
               value="en"
               data-component="header">
    <br>
<p>Example: <code>en</code></p>
            </div>
                        </form>

                <h1 id="user-authentication">User Authentication</h1>

    <p>APIs for user registration, authentication, and account management.
These endpoints handle user registration with email verification, login, password reset,
and other authentication-related functionality for both clients and freelancers.</p>

                                <h2 id="user-authentication-POSTapi-auth-register">User Registration.</h2>

<p>
</p>

<p>This endpoint initiates the user registration process by sending a verification code to the provided email.
Users can register as either freelancers or clients. Freelancers need to provide additional professional information.
After successful validation, a 4-digit OTP code will be sent to the email for verification.</p>

<span id="example-requests-POSTapi-auth-register">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://backend.shuwier.com/api/auth/register" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en" \
    --data "{
    \"name\": \"أحمد محمد\",
    \"email\": \"ahmed@example.com\",
    \"password\": \"Password123!\",
    \"type\": \"freelancer\",
    \"linkedin_link\": \"https:\\/\\/linkedin.com\\/in\\/ahmed\",
    \"twitter_link\": \"https:\\/\\/twitter.com\\/ahmed\",
    \"other_freelance_platform_links\": [
        \"https:\\/\\/upwork.com\\/freelancers\\/ahmed\"
    ],
    \"portfolio_link\": \"https:\\/\\/ahmed-portfolio.com\",
    \"password_confirmation\": \"Password123!\"
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
    "name": "أحمد محمد",
    "email": "ahmed@example.com",
    "password": "Password123!",
    "type": "freelancer",
    "linkedin_link": "https:\/\/linkedin.com\/in\/ahmed",
    "twitter_link": "https:\/\/twitter.com\/ahmed",
    "other_freelance_platform_links": [
        "https:\/\/upwork.com\/freelancers\/ahmed"
    ],
    "portfolio_link": "https:\/\/ahmed-portfolio.com",
    "password_confirmation": "Password123!"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-auth-register">
            <blockquote>
            <p>Example response (200, Verification code sent successfully):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Verification code sent successfully&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Email already exists):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The email has already been taken.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Email in invitation list):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The email is already in the invitation list.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Validation error):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The email field is required.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (429, Too many attempts):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 429,
    &quot;message&quot;: &quot;Too many verification attempts. Please try again later.&quot;
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
               value="أحمد محمد"
               data-component="body">
    <br>
<p>User's full name (Arabic or English). Example: <code>أحمد محمد</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-auth-register"
               value="ahmed@example.com"
               data-component="body">
    <br>
<p>User's email address (must be unique and valid). Example: <code>ahmed@example.com</code></p>
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
<p>Password (min 8 chars, must contain uppercase, lowercase, number, and special character). Example: <code>Password123!</code></p>
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
<p>User type. Must be either &quot;freelancer&quot; or &quot;client&quot;. Example: <code>freelancer</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>linkedin_link</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="linkedin_link"                data-endpoint="POSTapi-auth-register"
               value="https://linkedin.com/in/ahmed"
               data-component="body">
    <br>
<p>required_if:type,freelancer LinkedIn profile URL (required for freelancers). Example: <code>https://linkedin.com/in/ahmed</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>twitter_link</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="twitter_link"                data-endpoint="POSTapi-auth-register"
               value="https://twitter.com/ahmed"
               data-component="body">
    <br>
<p>required_if:type,freelancer Twitter profile URL (required for freelancers). Example: <code>https://twitter.com/ahmed</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>other_freelance_platform_links</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
<i>optional</i> &nbsp;
<br>
<p>required_if:type,freelancer Array of other freelance platform URLs (1-3 links, required for freelancers).</p>
            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>*</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="other_freelance_platform_links.*"                data-endpoint="POSTapi-auth-register"
               value="https://upwork.com/freelancers/ahmed"
               data-component="body">
    <br>
<p>URL format for each freelance platform link. Example: <code>https://upwork.com/freelancers/ahmed</code></p>
                    </div>
                                    </details>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>portfolio_link</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="portfolio_link"                data-endpoint="POSTapi-auth-register"
               value="https://ahmed-portfolio.com"
               data-component="body">
    <br>
<p>required_if:type,freelancer Portfolio website URL (required for freelancers). Example: <code>https://ahmed-portfolio.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password_confirmation</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password_confirmation"                data-endpoint="POSTapi-auth-register"
               value="Password123!"
               data-component="body">
    <br>
<p>Password confirmation (must match password). Example: <code>Password123!</code></p>
        </div>
        </form>

                    <h2 id="user-authentication-POSTapi-auth-resend-code">Resend Verification Code.</h2>

<p>
</p>

<p>This endpoint resends the verification code to the user's email if they didn't receive it
or if the previous code expired. Rate limiting applies to prevent spam.</p>

<span id="example-requests-POSTapi-auth-resend-code">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://backend.shuwier.com/api/auth/resend-code" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en" \
    --data "{
    \"email\": \"ahmed@example.com\"
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
    "email": "ahmed@example.com"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-auth-resend-code">
            <blockquote>
            <p>Example response (200, Code resent successfully):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Verification code resent successfully&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Email not found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;Email not found or already verified&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Rate limit exceeded):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;Please wait 60 seconds before requesting another code&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Validation error):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The email field is required.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (429, Too many attempts):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 429,
    &quot;message&quot;: &quot;Too many verification attempts. Please try again later.&quot;
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
               value="ahmed@example.com"
               data-component="body">
    <br>
<p>The email address to resend the verification code to. Example: <code>ahmed@example.com</code></p>
        </div>
        </form>

                    <h2 id="user-authentication-POSTapi-auth-verify-email">Verify Email and Complete Registration.</h2>

<p>
</p>

<p>This endpoint verifies the email OTP code sent during registration and completes the user account creation.</p>
<p><strong>Approval Status Logic:</strong></p>
<ul>
<li><strong>Clients</strong>: Always approved immediately and ready to use</li>
<li><strong>Freelancers with invitation</strong>: If the email has a pending invitation from admin, the freelancer will be approved immediately without admin review</li>
<li><strong>Regular freelancers</strong>: Account created with &quot;requested&quot; approval status and requires admin approval</li>
</ul>

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
            &quot;name&quot;: &quot;John Doe&quot;,
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
            <p>Example response (200, Invited freelancer registration completed (pre-approved)):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
  &quot;status&quot;: true,
  &quot;error_num&quot;: null,
  &quot;message&quot;: &quot;User registered successfully&quot;,
  &quot;data&quot;: {
    &quot;user&quot;: {
      &quot;id&quot;: 1,
      &quot;name&quot;: &quot;John Doe&quot;,
      &quot;email&quot;: &quot;john@example.com&quot;,
      &quot;type&quot;: &quot;freelancer&quot;,
      &quot;email_verified_at&quot;: &quot;2025-08-24T10:30:00.000000Z&quot;,
      &quot;phone&quot;: null,
      &quot;is_active&quot;: true,
      &quot;about_me&quot;: null,
      &quot;profile_picture&quot;: null,
      &quot;approval_status&quot;: &quot;approved&quot;,
      &quot;linkedin_link&quot;: &quot;https://linkedin.com/in/johndoe&quot;,
      &quot;twitter_link&quot;: &quot;https://twitter.com/johndoe&quot;,
      &quot;other_freelance_platform_links&quot;: [&quot;https://upwork.com/freelancers/johndoe&quot;],
      &quot;portfolio_link&quot;: &quot;https://johndoe.com&quot;,
      &quot;headline&quot;: null,
      &quot;description&quot;: null,
      &quot;created_at&quot;: &quot;2025-08-24T10:30:00.000000Z&quot;,
      &quot;updated_at&quot;: &quot;2025-08-24T10:30:00.000000Z&quot;
    },
    &quot;token&quot;: &quot;eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...&quot;
  }
}
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
            &quot;name&quot;: &quot;Jane Smith&quot;,
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

                    <h2 id="user-authentication-POSTapi-auth-reset-email">Reset Email Address.</h2>

<p>
</p>

<p>This endpoint allows users to change their email address during the registration process
if they have exceeded the maximum verification attempts. A new verification code will be sent
to the new email address.</p>

<span id="example-requests-POSTapi-auth-reset-email">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://backend.shuwier.com/api/auth/reset-email" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en" \
    --data "{
    \"old_email\": \"oldemail@example.com\",
    \"new_email\": \"newemail@example.com\"
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
    "old_email": "oldemail@example.com",
    "new_email": "newemail@example.com"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-auth-reset-email">
            <blockquote>
            <p>Example response (200, Email reset successfully):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Verification code sent to new email address&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Old email not found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;Verification session expired or old email not found&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Cannot change email yet):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;Cannot change email yet. Complete verification attempts first.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, New email already exists):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The new email has already been taken.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, New email in invitation list):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The new email is already in the invitation list.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Validation error):</p>
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
               value="oldemail@example.com"
               data-component="body">
    <br>
<p>The current email address that needs to be changed. Example: <code>oldemail@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>new_email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="new_email"                data-endpoint="POSTapi-auth-reset-email"
               value="newemail@example.com"
               data-component="body">
    <br>
<p>The new email address (must be unique in both users and invitations, and valid). Example: <code>newemail@example.com</code></p>
        </div>
        </form>

                    <h2 id="user-authentication-POSTapi-auth-login">Login.</h2>

<p>
</p>

<p>This endpoint authenticates users and returns a JWT token.</p>

<span id="example-requests-POSTapi-auth-login">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://backend.shuwier.com/api/auth/login" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en" \
    --data "{
    \"email\": \"user@example.com\",
    \"password\": \"password123\"
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
    "email": "user@example.com",
    "password": "password123"
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
        &quot;name&quot;: &quot;Jane Smith&quot;,
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
               value="user@example.com"
               data-component="body">
    <br>
<p>User email address. Example: <code>user@example.com</code></p>
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
<p>User password (minimum 6 characters). Example: <code>password123</code></p>
        </div>
        </form>

                    <h2 id="user-authentication-POSTapi-auth-forget-password">Forget Password - Send Reset Code.</h2>

<p>
</p>

<p>This endpoint initiates the password reset process by sending a verification code to the user's email.
A reset token is also generated and returned for use in the password reset process.</p>

<span id="example-requests-POSTapi-auth-forget-password">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://backend.shuwier.com/api/auth/forget-password" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en" \
    --data "{
    \"email\": \"user@example.com\"
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
    "email": "user@example.com"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-auth-forget-password">
            <blockquote>
            <p>Example response (200, Reset code sent successfully):</p>
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
            <p>Example response (400, Email not found):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The selected email is invalid.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Validation error):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The email field is required.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (429, Too many attempts):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 429,
    &quot;message&quot;: &quot;Too many verification attempts. Please try again later.&quot;
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
               value="user@example.com"
               data-component="body">
    <br>
<p>User's email address (must exist in the system). Example: <code>user@example.com</code></p>
        </div>
        </form>

                    <h2 id="user-authentication-POSTapi-auth-reset-password">Reset Password.</h2>

<p>
</p>

<p>This endpoint completes the password reset process using the verification code and reset token.
The user must first verify their email through the forget password flow before using this endpoint.</p>

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
    \"token\": \"abc123def456ghi789\",
    \"password\": \"NewPassword123!\",
    \"password_confirmation\": \"NewPassword123!\"
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
    "token": "abc123def456ghi789",
    "password": "NewPassword123!",
    "password_confirmation": "NewPassword123!"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-auth-reset-password">
            <blockquote>
            <p>Example response (200, Password reset successfully):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Password reset successfully&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Verification session expired):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;Verification session expired or not found&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Verification code not verified):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;Email verification required before password reset&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Invalid token):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;Invalid or expired reset token&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Validation error):</p>
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
<p>User's email address. Example: <code>user@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>token</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="token"                data-endpoint="POSTapi-auth-reset-password"
               value="abc123def456ghi789"
               data-component="body">
    <br>
<p>Reset token received from forget password endpoint. Example: <code>abc123def456ghi789</code></p>
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
<p>New password (min 8 chars, must contain uppercase, lowercase, number, and special character). Example: <code>NewPassword123!</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password_confirmation</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password_confirmation"                data-endpoint="POSTapi-auth-reset-password"
               value="NewPassword123!"
               data-component="body">
    <br>
<p>Password confirmation (must match password). Example: <code>NewPassword123!</code></p>
        </div>
        </form>

                    <h2 id="user-authentication-POSTapi-auth-change-password">Change User Password.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>This endpoint allows authenticated users to change their password by providing their current password
and a new password. The current password must be verified before the new password is set.
This is a secure way for users to update their passwords while logged in.</p>

<span id="example-requests-POSTapi-auth-change-password">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://backend.shuwier.com/api/auth/change-password" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en" \
    --data "{
    \"current_password\": \"CurrentPassword123!\",
    \"new_password\": \"NewPassword123!\",
    \"new_password_confirmation\": \"NewPassword123!\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/auth/change-password"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

let body = {
    "current_password": "CurrentPassword123!",
    "new_password": "NewPassword123!",
    "new_password_confirmation": "NewPassword123!"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-auth-change-password">
            <blockquote>
            <p>Example response (200, Password changed successfully):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Password changed successfully&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Current password incorrect):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;Current password is incorrect&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Password change failed):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;Failed to change password. Please try again.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Validation error):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The current_password field is required.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Password confirmation mismatch):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The new_password confirmation does not match.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Password too weak):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The new_password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, Unauthenticated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 401,
    &quot;message&quot;: &quot;Unauthenticated&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-auth-change-password" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-auth-change-password"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-auth-change-password"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-auth-change-password" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-auth-change-password">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-auth-change-password" data-method="POST"
      data-path="api/auth/change-password"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-auth-change-password', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-auth-change-password"
                    onclick="tryItOut('POSTapi-auth-change-password');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-auth-change-password"
                    onclick="cancelTryOut('POSTapi-auth-change-password');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-auth-change-password"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/auth/change-password</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-auth-change-password"
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
                              name="Accept"                data-endpoint="POSTapi-auth-change-password"
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
                              name="Accept-Language"                data-endpoint="POSTapi-auth-change-password"
               value="en"
               data-component="header">
    <br>
<p>Example: <code>en</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>current_password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="current_password"                data-endpoint="POSTapi-auth-change-password"
               value="CurrentPassword123!"
               data-component="body">
    <br>
<p>User's current password for verification. Example: <code>CurrentPassword123!</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>new_password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="new_password"                data-endpoint="POSTapi-auth-change-password"
               value="NewPassword123!"
               data-component="body">
    <br>
<p>New password (min 8 chars, must contain uppercase, lowercase, number, and special character). Example: <code>NewPassword123!</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>new_password_confirmation</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="new_password_confirmation"                data-endpoint="POSTapi-auth-change-password"
               value="NewPassword123!"
               data-component="body">
    <br>
<p>Password confirmation (must match new_password). Example: <code>NewPassword123!</code></p>
        </div>
        </form>

                    <h2 id="user-authentication-POSTapi-auth-change-email">Change Email Address.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>This endpoint allows authenticated users to change their email address by providing a new email
and confirming their current password. A verification code will be sent to the new email address
for verification. The user must then use the verifyChangeEmail endpoint to complete the email change.
<strong>Rate Limiting:</strong> This endpoint is limited to 3 attempts per week per user to prevent abuse.</p>

<span id="example-requests-POSTapi-auth-change-email">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://backend.shuwier.com/api/auth/change-email" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en" \
    --data "{
    \"email\": \"newemail@example.com\",
    \"password\": \"CurrentPassword123!\",
    \"email_confirmation\": \"newemail@example.com\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/auth/change-email"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

let body = {
    "email": "newemail@example.com",
    "password": "CurrentPassword123!",
    "email_confirmation": "newemail@example.com"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-auth-change-email">
            <blockquote>
            <p>Example response (200, Email change initiated successfully):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Verification code sent to new email address&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Current password incorrect):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;Current password is incorrect&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, New email already exists):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The email has already been taken.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, New email in invitation list):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The email is already in the invitation list.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Validation error - Password confirmation mismatch):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The password confirmation does not match.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Validation error - Invalid email format):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The email must be a valid email address.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Validation error - Missing fields):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The email field is required.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, Unauthenticated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 401,
    &quot;message&quot;: &quot;Unauthenticated&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-auth-change-email" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-auth-change-email"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-auth-change-email"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-auth-change-email" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-auth-change-email">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-auth-change-email" data-method="POST"
      data-path="api/auth/change-email"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-auth-change-email', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-auth-change-email"
                    onclick="tryItOut('POSTapi-auth-change-email');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-auth-change-email"
                    onclick="cancelTryOut('POSTapi-auth-change-email');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-auth-change-email"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/auth/change-email</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-auth-change-email"
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
                              name="Accept"                data-endpoint="POSTapi-auth-change-email"
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
                              name="Accept-Language"                data-endpoint="POSTapi-auth-change-email"
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
                              name="email"                data-endpoint="POSTapi-auth-change-email"
               value="newemail@example.com"
               data-component="body">
    <br>
<p>The new email address (must be unique and valid). Example: <code>newemail@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-auth-change-email"
               value="CurrentPassword123!"
               data-component="body">
    <br>
<p>Current password confirmation (min 8 chars, must contain uppercase, lowercase, number, and special character). Example: <code>CurrentPassword123!</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email_confirmation</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email_confirmation"                data-endpoint="POSTapi-auth-change-email"
               value="newemail@example.com"
               data-component="body">
    <br>
<p>Email confirmation (must match email). Example: <code>newemail@example.com</code></p>
        </div>
        </form>

                    <h2 id="user-authentication-POSTapi-auth-verify-change-email">Verify Email Change.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>This endpoint verifies the OTP code sent to the new email address during the email change process.
Users must first initiate an email change using the changeEmail endpoint, then use this endpoint
to verify the new email address with the 4-digit OTP code sent to the new email.</p>

<span id="example-requests-POSTapi-auth-verify-change-email">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://backend.shuwier.com/api/auth/verify-change-email" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en" \
    --data "{
    \"email\": \"newemail@example.com\",
    \"otp\": \"1234\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/auth/verify-change-email"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

let body = {
    "email": "newemail@example.com",
    "otp": "1234"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-auth-verify-change-email">
            <blockquote>
            <p>Example response (200, Email change verified successfully):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Email changed successfully&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Invalid or expired OTP):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;Invalid or expired verification code&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Email change session expired):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;Email change session expired or not found&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Email verification not initiated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;No email change request found for this email&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Validation error - Invalid email format):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The email must be a valid email address.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Validation error - Invalid OTP format):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The otp must be 4 digits.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Validation error - Missing fields):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The email field is required.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, Unauthenticated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 401,
    &quot;message&quot;: &quot;Unauthenticated&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-auth-verify-change-email" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-auth-verify-change-email"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-auth-verify-change-email"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-auth-verify-change-email" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-auth-verify-change-email">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-auth-verify-change-email" data-method="POST"
      data-path="api/auth/verify-change-email"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-auth-verify-change-email', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-auth-verify-change-email"
                    onclick="tryItOut('POSTapi-auth-verify-change-email');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-auth-verify-change-email"
                    onclick="cancelTryOut('POSTapi-auth-verify-change-email');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-auth-verify-change-email"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/auth/verify-change-email</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-auth-verify-change-email"
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
                              name="Accept"                data-endpoint="POSTapi-auth-verify-change-email"
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
                              name="Accept-Language"                data-endpoint="POSTapi-auth-verify-change-email"
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
                              name="email"                data-endpoint="POSTapi-auth-verify-change-email"
               value="newemail@example.com"
               data-component="body">
    <br>
<p>The new email address to verify (must be the same email used in changeEmail). Example: <code>newemail@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>otp</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="otp"                data-endpoint="POSTapi-auth-verify-change-email"
               value="1234"
               data-component="body">
    <br>
<p>The 4-digit verification code sent to the new email address. Example: <code>1234</code></p>
        </div>
        </form>

                    <h2 id="user-authentication-GETapi-auth-profile">Get User Profile.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>This endpoint retrieves the authenticated user's profile information.
Returns different data structures based on user type (freelancer or client).
Freelancers will get additional fields like skills, category, portfolio links, etc.
Clients will get basic profile information along with company details.</p>

<span id="example-requests-GETapi-auth-profile">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://backend.shuwier.com/api/auth/profile" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/auth/profile"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-auth-profile">
            <blockquote>
            <p>Example response (200, Freelancer profile):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Profile retrieved successfully&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;أحمد محمد&quot;,
        &quot;email&quot;: &quot;ahmed@example.com&quot;,
        &quot;type&quot;: &quot;freelancer&quot;,
        &quot;email_verified_at&quot;: &quot;2025-08-24T10:30:00.000000Z&quot;,
        &quot;phone&quot;: null,
        &quot;is_active&quot;: true,
        &quot;about_me&quot;: &quot;مطور ويب محترف مع خبرة 5 سنوات&quot;,
        &quot;profile_picture&quot;: &quot;storage/profiles/ahmed_profile.jpg&quot;,
        &quot;approval_status&quot;: &quot;approved&quot;,
        &quot;linkedin_link&quot;: &quot;https://linkedin.com/in/ahmed&quot;,
        &quot;twitter_link&quot;: &quot;https://twitter.com/ahmed&quot;,
        &quot;other_freelance_platform_links&quot;: [
            &quot;https://upwork.com/freelancers/ahmed&quot;
        ],
        &quot;portfolio_link&quot;: &quot;https://ahmed-portfolio.com&quot;,
        &quot;headline&quot;: &quot;Full Stack Developer &amp; UI/UX Designer&quot;,
        &quot;description&quot;: &quot;Experienced developer specializing in Laravel and React&quot;,
        &quot;category&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Web Development&quot;
        },
        &quot;skills&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;PHP&quot;
            },
            {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;Laravel&quot;
            },
            {
                &quot;id&quot;: 3,
                &quot;name&quot;: &quot;React&quot;
            }
        ],
        &quot;portfolios&quot;: [],
        &quot;created_at&quot;: &quot;2025-08-24T10:30:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-08-24T10:30:00.000000Z&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (200, Client profile):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Profile retrieved successfully&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 2,
        &quot;name&quot;: &quot;Jane Smith&quot;,
        &quot;email&quot;: &quot;jane@example.com&quot;,
        &quot;email_verified_at&quot;: &quot;2025-08-24T10:30:00.000000Z&quot;,
        &quot;phone&quot;: &quot;+1234567890&quot;,
        &quot;type&quot;: &quot;client&quot;,
        &quot;is_active&quot;: true,
        &quot;about_me&quot;: &quot;Business owner looking for quality freelance services&quot;,
        &quot;profile_picture&quot;: &quot;storage/profiles/jane_profile.jpg&quot;,
        &quot;company&quot;: &quot;Tech Solutions Inc&quot;,
        &quot;created_at&quot;: &quot;2025-08-24T10:30:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-08-24T10:30:00.000000Z&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Profile retrieval failed):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;Unable to retrieve profile information&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, Unauthenticated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 401,
    &quot;message&quot;: &quot;Unauthenticated&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-auth-profile" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-auth-profile"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-auth-profile"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-auth-profile" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-auth-profile">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-auth-profile" data-method="GET"
      data-path="api/auth/profile"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-auth-profile', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-auth-profile"
                    onclick="tryItOut('GETapi-auth-profile');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-auth-profile"
                    onclick="cancelTryOut('GETapi-auth-profile');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-auth-profile"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/auth/profile</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-auth-profile"
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
                              name="Accept"                data-endpoint="GETapi-auth-profile"
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
                              name="Accept-Language"                data-endpoint="GETapi-auth-profile"
               value="en"
               data-component="header">
    <br>
<p>Example: <code>en</code></p>
            </div>
                        </form>

                    <h2 id="user-authentication-POSTapi-auth-profile">Update User Profile.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>This endpoint allows authenticated users to update their profile information.
The endpoint supports both freelancers and clients with different validation rules based on user type.
Uses request filtering to only accept valid fields for each user type.</p>
<p><strong>For Freelancers:</strong></p>
<ul>
<li>Allowed fields: name, profile_picture, about_me, country, city, languages, headline, category_id, skill_ids</li>
<li>Optional fields: name, profile_picture, about_me, country, city, languages, headline, category_id, skill_ids</li>
<li>Prohibited fields: company, phone</li>
</ul>
<p><strong>For Clients:</strong></p>
<ul>
<li>Allowed fields: name, profile_picture, about_me, country, city, languages, company, phone</li>
<li>Optional fields: name, profile_picture, about_me, country, city, languages, company, phone</li>
<li>Prohibited fields: headline, category_id, skill_ids</li>
</ul>

<span id="example-requests-POSTapi-auth-profile">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://backend.shuwier.com/api/auth/profile" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: en" \
    --data "{
    \"name\": \"أحمد محمد\",
    \"about_me\": \"مطور ويب محترف مع خبرة 5 سنوات\",
    \"country\": \"Saudi Arabia\",
    \"city\": \"Riyadh\",
    \"languages\": [
        {
            \"language_id\": 1,
            \"language_level\": \"native\"
        },
        {
            \"language_id\": 2,
            \"language_level\": \"advanced\"
        }
    ],
    \"headline\": \"Full Stack Developer\",
    \"category_id\": 1,
    \"skill_ids\": [
        1,
        2,
        3
    ],
    \"company\": \"Tech Solutions Inc\",
    \"phone\": \"+966501234567\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/auth/profile"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "en",
};

let body = {
    "name": "أحمد محمد",
    "about_me": "مطور ويب محترف مع خبرة 5 سنوات",
    "country": "Saudi Arabia",
    "city": "Riyadh",
    "languages": [
        {
            "language_id": 1,
            "language_level": "native"
        },
        {
            "language_id": 2,
            "language_level": "advanced"
        }
    ],
    "headline": "Full Stack Developer",
    "category_id": 1,
    "skill_ids": [
        1,
        2,
        3
    ],
    "company": "Tech Solutions Inc",
    "phone": "+966501234567"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-auth-profile">
            <blockquote>
            <p>Example response (200, Freelancer profile updated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Profile updated successfully&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;أحمد محمد&quot;,
        &quot;email&quot;: &quot;ahmed@example.com&quot;,
        &quot;type&quot;: &quot;freelancer&quot;,
        &quot;email_verified_at&quot;: &quot;2025-08-24T10:30:00.000000Z&quot;,
        &quot;phone&quot;: null,
        &quot;is_active&quot;: true,
        &quot;about_me&quot;: &quot;مطور ويب محترف مع خبرة 5 سنوات&quot;,
        &quot;profile_picture&quot;: &quot;storage/profiles/ahmed_profile.jpg&quot;,
        &quot;approval_status&quot;: &quot;approved&quot;,
        &quot;linkedin_link&quot;: &quot;https://linkedin.com/in/ahmed&quot;,
        &quot;twitter_link&quot;: &quot;https://twitter.com/ahmed&quot;,
        &quot;other_freelance_platform_links&quot;: [
            &quot;https://upwork.com/freelancers/ahmed&quot;
        ],
        &quot;portfolio_link&quot;: &quot;https://ahmed-portfolio.com&quot;,
        &quot;headline&quot;: &quot;Full Stack Developer&quot;,
        &quot;description&quot;: &quot;Experienced developer specializing in Laravel and React&quot;,
        &quot;category&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Web Development&quot;
        },
        &quot;skills&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;PHP&quot;
            },
            {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;Laravel&quot;
            },
            {
                &quot;id&quot;: 3,
                &quot;name&quot;: &quot;React&quot;
            }
        ],
        &quot;portfolios&quot;: [],
        &quot;created_at&quot;: &quot;2025-08-24T10:30:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-08-24T10:30:00.000000Z&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (200, Client profile updated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Profile updated successfully&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 2,
        &quot;name&quot;: &quot;Jane Smith&quot;,
        &quot;email&quot;: &quot;jane@example.com&quot;,
        &quot;email_verified_at&quot;: &quot;2025-08-24T10:30:00.000000Z&quot;,
        &quot;phone&quot;: &quot;+966501234567&quot;,
        &quot;type&quot;: &quot;client&quot;,
        &quot;is_active&quot;: true,
        &quot;about_me&quot;: &quot;Business owner looking for quality freelance services&quot;,
        &quot;profile_picture&quot;: &quot;storage/profiles/jane_profile.jpg&quot;,
        &quot;company&quot;: &quot;Tech Solutions Inc&quot;,
        &quot;created_at&quot;: &quot;2025-08-24T10:30:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-08-24T10:30:00.000000Z&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Freelancer not approved):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;You are not an approved freelancer&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Invalid category):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;This category is not a parent category&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Validation error - Name format):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The name format is invalid.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Validation error - Prohibited field):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The company field is prohibited.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Validation error - File too large):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The profile picture may not be greater than 2048 kilobytes.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400, Validation error - Invalid skill):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400,
    &quot;message&quot;: &quot;The selected skill_ids.0 is invalid.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, Unauthenticated):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 401,
    &quot;message&quot;: &quot;Unauthenticated&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-auth-profile" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-auth-profile"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-auth-profile"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-auth-profile" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-auth-profile">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-auth-profile" data-method="POST"
      data-path="api/auth/profile"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-auth-profile', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-auth-profile"
                    onclick="tryItOut('POSTapi-auth-profile');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-auth-profile"
                    onclick="cancelTryOut('POSTapi-auth-profile');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-auth-profile"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/auth/profile</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-auth-profile"
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
                              name="Accept"                data-endpoint="POSTapi-auth-profile"
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
                              name="Accept-Language"                data-endpoint="POSTapi-auth-profile"
               value="en"
               data-component="header">
    <br>
<p>Example: <code>en</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-auth-profile"
               value="أحمد محمد"
               data-component="body">
    <br>
<p>sometimes User's full name (Arabic or English characters only). Example: <code>أحمد محمد</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>profile_picture</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="file" style="display: none"
                              name="profile_picture"                data-endpoint="POSTapi-auth-profile"
               value=""
               data-component="body">
    <br>
<p>sometimes Profile picture image file (max 2MB). Example:</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>about_me</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="about_me"                data-endpoint="POSTapi-auth-profile"
               value="مطور ويب محترف مع خبرة 5 سنوات"
               data-component="body">
    <br>
<p>sometimes About me description (max 500 characters, optional). Example: <code>مطور ويب محترف مع خبرة 5 سنوات</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>country</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="country"                data-endpoint="POSTapi-auth-profile"
               value="Saudi Arabia"
               data-component="body">
    <br>
<p>sometimes User country (max 100 characters, optional). Example: <code>Saudi Arabia</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>city</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="city"                data-endpoint="POSTapi-auth-profile"
               value="Riyadh"
               data-component="body">
    <br>
<p>sometimes User city (max 100 characters, optional). Example: <code>Riyadh</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>languages</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
<i>optional</i> &nbsp;
<br>
<p>sometimes Array of user languages (optional).</p>
            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>language_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="languages.0.language_id"                data-endpoint="POSTapi-auth-profile"
               value="1"
               data-component="body">
    <br>
<p>Language ID (must exist in languages table). This field is required when <code>languages.*</code> is present. The <code>id</code> of an existing record in the languages table. Example: <code>1</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>language_level</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="languages.0.language_level"                data-endpoint="POSTapi-auth-profile"
               value="advanced"
               data-component="body">
    <br>
<p>Language proficiency level. This field is required when <code>languages.*</code> is present. Example: <code>advanced</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>basic</code></li> <li><code>intermediate</code></li> <li><code>advanced</code></li> <li><code>native</code></li></ul>
                    </div>
                                                                <div style=" margin-left: 14px; clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>*</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
<br>

            </summary>
                                                <div style="margin-left: 28px; clear: unset;">
                        <b style="line-height: 2;"><code>language_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="languages.*.language_id"                data-endpoint="POSTapi-auth-profile"
               value="1"
               data-component="body">
    <br>
<p>Language ID (must exist in languages table). Example: <code>1</code></p>
                    </div>
                                                                <div style="margin-left: 28px; clear: unset;">
                        <b style="line-height: 2;"><code>language_level</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="languages.*.language_level"                data-endpoint="POSTapi-auth-profile"
               value="advanced"
               data-component="body">
    <br>
<p>Language proficiency level (basic, intermediate, advanced, native). Example: <code>advanced</code></p>
                    </div>
                                    </details>
        </div>
                                        </details>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>headline</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="headline"                data-endpoint="POSTapi-auth-profile"
               value="Full Stack Developer"
               data-component="body">
    <br>
<p>sometimes Professional headline (for freelancers only, optional). Example: <code>Full Stack Developer</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>category_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="category_id"                data-endpoint="POSTapi-auth-profile"
               value="1"
               data-component="body">
    <br>
<p>sometimes Main category ID (for freelancers only, optional, must exist in categories). Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>skill_ids</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
<i>optional</i> &nbsp;
<br>
<p>sometimes Array of skill IDs (for freelancers only, optional).</p>
            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>*</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="skill_ids.*"                data-endpoint="POSTapi-auth-profile"
               value="1"
               data-component="body">
    <br>
<p>Each skill ID must exist in skills table. Example: <code>1</code></p>
                    </div>
                                    </details>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>company</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="company"                data-endpoint="POSTapi-auth-profile"
               value="Tech Solutions Inc"
               data-component="body">
    <br>
<p>sometimes Company name (for clients only, optional, max 255 characters). Example: <code>Tech Solutions Inc</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="phone"                data-endpoint="POSTapi-auth-profile"
               value="+966501234567"
               data-component="body">
    <br>
<p>sometimes Phone number in Saudi format (for clients only, optional). Example: <code>+966501234567</code></p>
        </div>
        </form>

                    <h2 id="user-authentication-POSTapi-auth-logout">User Logout.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>This endpoint logs out the authenticated user by invalidating their JWT token.
After logout, the token cannot be used for authentication.</p>

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
            <p>Example response (200, Logout successful):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;error_num&quot;: null,
    &quot;message&quot;: &quot;Logout successful&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, Unauthenticated):</p>
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

                    <h2 id="user-authentication-POSTapi-auth-refresh">Refresh Token.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>This endpoint refreshes the user's JWT token, providing a new token with extended expiration time.
Use this endpoint to maintain user sessions without requiring re-authentication.</p>

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
            <p>Example response (200, Token refreshed successfully):</p>
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
            <p>Example response (401, Token invalid or expired):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;error_num&quot;: 401,
    &quot;message&quot;: &quot;Token could not be refreshed&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, Unauthenticated):</p>
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

                <h1 id="user-verification">User Verification</h1>

    

                                <h2 id="user-verification-POSTapi-verifications">Submit User Verification Request</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Submit documents for user verification. Users can upload one or two verification documents.</p>

<span id="example-requests-POSTapi-verifications">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://backend.shuwier.com/api/verifications" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --header "Accept-Language: en" \
    --form "document_one=@/private/var/folders/bh/ymm81xv929z74_28m5_265d40000gn/T/phpDsQgi0" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://backend.shuwier.com/api/verifications"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
    "Accept-Language": "en",
};

const body = new FormData();
body.append('document_one', document.querySelector('input[name="document_one"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-verifications">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Verification request submitted successfully&quot;,
    &quot;status&quot;: true,
    &quot;error_num&quot;: null
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The document one field is required.&quot;,
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;File size must not exceed 2MB&quot;,
    &quot;status&quot;: false,
    &quot;error_num&quot;: 400
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated&quot;,
    &quot;status&quot;: false,
    &quot;error_num&quot;: 401
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-verifications" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-verifications"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-verifications"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-verifications" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-verifications">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-verifications" data-method="POST"
      data-path="api/verifications"
      data-authed="1"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-verifications', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-verifications"
                    onclick="tryItOut('POSTapi-verifications');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-verifications"
                    onclick="cancelTryOut('POSTapi-verifications');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-verifications"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/verifications</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-verifications"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-verifications"
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
                              name="Accept-Language"                data-endpoint="POSTapi-verifications"
               value="en"
               data-component="header">
    <br>
<p>Example: <code>en</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>document_one</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="document_one"                data-endpoint="POSTapi-verifications"
               value=""
               data-component="body">
    <br>
<p>The first verification document. Must be an image (png, jpg, jpeg, webp) or PDF file, max 2MB. Example: Example: <code>/private/var/folders/bh/ymm81xv929z74_28m5_265d40000gn/T/phpDsQgi0</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>document_two</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="file" style="display: none"
                              name="document_two"                data-endpoint="POSTapi-verifications"
               value=""
               data-component="body">
    <br>
<p>optional The second verification document. Must be an image (png, jpg, jpeg, webp) or PDF file, max 2MB. Example:</p>
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
