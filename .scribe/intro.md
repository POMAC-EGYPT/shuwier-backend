# Introduction



<aside>
    <strong>Base URL</strong>: <code>http://backend.shuwier.com</code>
</aside>

    This documentation aims to provide all the information you need to work with our API.

    <aside>As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
    You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).</aside>
    
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
    ```

