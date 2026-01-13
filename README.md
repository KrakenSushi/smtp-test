# SMTP Tester

<p>Integrate Microsoft Exchange to a Laravel App, use it for SMTP.</p>

## Azure Setup

#### Get Keys
1. Login to Azure Portal → Microsoft Entra ID
2. App registrations → New registration<br>
	•	Name: **System** SMTP<br>
	•	Supported account type: Single tenant<br>
	•	Redirect URI: leave empty<br><br>
3. Take note of:<br>
	•	Application (client) ID<br>
	•	Directory (tenant) ID<br><br>
4. Create a Client Secret\
    •	Description: **System** SMTP<br>
	•	Expiry: 24 months or longer<br><br>
5. Take note of the <b>Secret Value</b>

#### Add API Permissions
1. API permissions → Add a permission
2. Choose <b>Microsoft Graph</b>
3. Add these Application permissions:<br>
	•	Mail.ReadWrite<br>
	•	Mail.Send<br><br>
4. Grant admin consent <b>(Important!)</b> <br>

#### Enable SMTP AUTH for the mailbox
1. Go to Microsoft 365 Admin Center:
2. Users → Active users
3. Select the mailbox
4. Mail → Manage email apps
5. Enable Authenticated SMTP


## Laravel Setup

#### Install required Dependencies
<pre> composer require agabaandre-office365/exchange-email-service innoge/laravel-msgraph-mail 
</pre>

#### Modify files

config/mail.php
<pre>
'microsoft-graph' => [
    'transport' => 'microsoft-graph',
    'client_id' => env('GRAPH_CLIENT_ID'),
    'client_secret' => env('GRAPH_CLIENT_SECRET'),
    'tenant_id' => env('GRAPH_TENANT_ID'),
    'from' => [
        'address' => env('MAIL_FROM_ADDRESS'),
        'name' => env('MAIL_FROM_NAME'),
    ],
    'save_to_sent_items' =>  env('MAIL_SAVE_TO_SENT_ITEMS', false),
],
</pre>
<br>
.env
<pre>
MAIL_MAILER=microsoft-graph
MAIL_HOST=smtp.office365.com
MAIL_PORT=587
MAIL_ENCRYPTION=tls
MAIL_USERNAME=E*email*
MAIL_FROM_ADDRESS=E*email*
MAIL_FROM_NAME="${APP_NAME}"

GRAPH_TENANT_ID=*key*
GRAPH_CLIENT_ID=*key*
GRAPH_CLIENT_SECRET=*key*
MAIL_SAVE_TO_SENT_ITEMS=false
</pre>