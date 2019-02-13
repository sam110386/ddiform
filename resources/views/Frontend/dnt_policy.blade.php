@extends('layouts.default')

@section('content')
<div class="container">
  <div class="row p-4">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default ">
        <div class="panel-body ">
          <h1 class="text-center text-uppercase">Do Not Track Compliance Policy</h1>

          <p>Version 1.0</p>
          <p>This domain complies with user opt-outs from tracking via the "Do Not Track" or "DNT" header [http://www.w3.org/TR/tracking-dnt/]. This file will always be posted via HTTPS at https://example-domain.com/.well-known/dnt-policy.txt to indicate this fact.</p>
          <h2>SCOPE</h2>
          <p>This policy document allows an operator of a Fully Qualified Domain Name ("domain") to declare that it respects Do Not Track as a meaningful privacy opt-out of tracking, so that privacy-protecting software can better determine whether to block or anonymize communications with this domain. This policy is intended first and foremost to be posted on domains that publish ads, widgets, images, scripts and other third-party embedded hypertext (for instance on widgets.example.com), but it can be posted on any domain, including those users visit directly (such as www.example.com). The policy may be applied to some domains used by a company, site, or service, and not to others. Do Not Track may be sent by any client that uses the HTTP protocol, including websites, mobile apps, and smart devices like TVs. Do Not Track also works with all protocols able to read HTTP headers, including SPDY.</p>
          <p>NOTE: This policy contains both Requirements and Exceptions. Where possible terms are defined in the text, but a few additional definitions are included at the end.</p>
          <h2>REQUIREMENTS</h2>
          <p>When this domain receives Web requests from a user who enables DNT by actively choosing an opt-out setting in their browser or by installing software that is primarily designed to protect privacy ("DNT User"), we will take the following measures with respect to those users' data, subject to the Exceptions, also listed below:</p>
          <h2>1. END USER IDENTIFIERS:</h2>
          <p>a. If a DNT User has logged in to our service, all user identifiers, such as  unique or nearly unique cookies, "supercookies" and fingerprints are discarded as soon as the HTTP(S) response is issued.</p>
          <p>Data structures which associate user identifiers with accounts may be employed to recognize logged in users per Exception 4 below, but may not  be associated with records of the user's activities unless otherwise  excepted.</p>
          <p>b. If a DNT User is not logged in to our service, we will take steps to ensure that no user identifiers are transmitted to us at all.</p>
          <h2>2. LOG RETENTION:</h2>
          <p>a. Logs with DNT Users' identifiers removed (but including IP addresses and User Agent strings) may be retained for a period of 10 days or less, unless an Exception (below) applies. This period of time balances privacy concerns with the need to ensure that log processing systems have time to operate; that operations engineers have time to monitor and fix technical and performance problems; and that security and data aggregation systems have time to operate.</p>
          <p>b. These logs will not be used for any other purposes.</p>
          <h2>3. OTHER DOMAINS:</h2>
          <p>a. If this domain transfers identifiable user data about DNT Users to contractors, affiliates or other parties, or embeds from or posts data to other domains, we will either:</p>
          <p>b. ensure that the operators of those domains abide by this policy overall by posting it at /.well-known/dnt-policy.txt via HTTPS on the domains in question,</p>
          <p>OR</p>
          <p>ensure that the recipient's policies and practices require the recipient to respect the policy for our DNT Users' data.</p>
          <p>OR</p>
          <p>obtain a contractual commitment from the recipient to respect this policy for our DNT Users' data.</p>
          <p>NOTE: if an &ldquo;Other Domain&rdquo; does not receive identifiable user information from the domain because such information has been removed, because the Other Domain does not log that information, or for some other reason, these requirements do not apply.</p>
          <p>c. "Identifiable" means any records which are not Anonymized or otherwise covered by the Exceptions below.</p>
          <h2>4. PERIODIC REASSERTION OF COMPLIANCE:</h2>
          <p>At least once every 12 months, we will take reasonable steps commensurate with the size of our organization and the nature of our service to confirm our ongoing compliance with this document, and we will publicly reassert our compliance.</p>
          <h2>5. USER NOTIFICATION:</h2>
          <p>a. If we are required by law to retain or disclose user identifiers, we will attempt to provide the users with notice (unless we are prohibited or it would be futile) that a request for their information has been made in order to give the users an opportunity to object to the retention or disclosure.</p>
          <p>b. We will attempt to provide this notice by email, if the users have given us an email address, and by postal mail if the users have provided a postal address.</p>
          <p>c. If the users do not challenge the disclosure request, we may be legally required to turn over their information.</p>
          <p>d. We may delay notice if we, in good faith, believe that an emergency involving danger of death or serious physical injury to any person requires disclosure without delay of information relating to the emergency.</p>
          <h2>EXCEPTIONS</h2>
          <p>Data from DNT Users collected by this domain may be logged or retained only in the following specific situations:</p>
          <h2>1. CONSENT / "OPT BACK IN"</h2>
          <p>a. DNT Users are opting out from tracking across the Web. It is possible that for some feature or functionality, we will need to ask a DNT User to "opt back in" to be tracked by us across the entire Web.</p>
          <p>b. If we do that, we will take reasonable steps to verify that the users who select this option have genuinely intended to opt back in to tracking. One way to do this is by performing scientifically reasonable user studies with a representative sample of our users, but smaller organizations can satisfy this requirement by other means.</p>
          <p>c. Where we believe that we have opt back in consent, our server will send a tracking value status header "Tk: C" as described in section 6.2 of the W3C Tracking Preference Expression draft:</p>
          <p>http://www.w3.org/TR/tracking-dnt/#tracking-status-value</p>
          <h2>2. TRANSACTIONS</h2>
          <p>If a DNT User actively and knowingly enters a transaction with our services (for instance, clicking on a clearly-labeled advertisement, posting content to a widget, or purchasing an item), we will retain necessary data for as long as required to perform the transaction. This may for example include keeping auditing information for clicks on advertising links; keeping a copy of posted content and the name of the posting user; keeping server-side session IDs to recognize logged in users; or keeping a copy of the physical address to which a purchased item will be shipped. By their nature, some transactions will require data to be retained indefinitely.</p>
          <h2>3. TECHNICAL AND SECURITY LOGGING:</h2>
          <p>a. If, during the processing of the initial request (for unique identifiers) or during the subsequent 10 days (for IP addresses and User Agent strings), we obtain specific information that causes our employees or systems to believe that a request is, or is likely to be, part of a security attack, spam submission, or fraudulent transaction, then logs of those requests  are not subject to this policy.</p>
          <p>b. If we encounter technical problems with our site, then, in rare circumstances, we may retain logs for longer than 10 days, if that is necessary to diagnose and fix those problems, but this practice will not be routinized and we will strive to delete such logs as soon as possible.</p>
          <h2>4. AGGREGATION:</h2>
          <p>a. We may retain and share anonymized datasets, such as aggregate records of readership patterns; statistical models of user behavior; graphs of system variables; data structures to count active users on monthly or yearly bases; database tables mapping authentication cookies to logged in accounts; non-unique data structures constructed within browsers for tasks such as ad frequency capping or conversion tracking; or logs with truncated and/or encrypted IP addresses and simplified User Agent strings.</p>
          <p>b. "Anonymized" means we have conducted risk mitigation to ensure that the dataset, plus any additional information that is in our possession or likely to be available to us, does not allow the reconstruction of reading habits, online or offline activity of groups of fewer than 5000 individuals or devices.</p>
          <p>c. If we generate anonymized datasets under this exception we will publicly document our anonymization methods in sufficient detail to allow outside experts to evaluate the effectiveness of those methods.</p>
          <h2>5. ERRORS:</h2>
          <p>From time to time, there may be errors by which user data is temporarily logged or retained in violation of this policy. If such errors are inadvertent, rare, and made in good faith, they do not constitute a breach of this policy. We will delete such data as soon as practicable after we become aware of any error and take steps to ensure that it is deleted by any third-party who may have had access to the data.</p>
          <h2>ADDITIONAL DEFINITIONS</h2>
          <p>"Fully Qualified Domain Name" means a domain name that addresses a computer connected to the Internet. For instance, example1.com; www.example1.com; ads.example1.com; and widgets.example2.com are all distinct FQDNs.</p>
          <p>"Supercookie" means any technology other than an HTTP Cookie which can be used by a server to associate identifiers with the clients that visit it. Examples of supercookies include Flash LSO cookies, DOM storage, HTML5 storage, or tricks to store information in caches or etags.</p>
          <p>"Risk mitigation" means an engineering process that evaluates the possibility and likelihood of various adverse outcomes, considers the available methods of making those adverse outcomes less likely, and deploys sufficient mitigations to bring the probability and harm from adverse outcomes below an acceptable threshold.</p>
          <p>"Reading habits" includes amongst other things lists of visited DNS names, if those domains pertain to specific topics or activities, but records of visited DNS names are not reading habits if those domain names serve content of a very diverse and general nature, thereby revealing minimal information about the opinions, interests or activities of the user.</p>
          <p>&nbsp;</p>
          <h2>Contact Us</h2>
          <p>If you have any questions about this Policy, please contact us:</p>
          <ul>
            <li>By email: info@gridble.com</li>
            
          </ul>

        </div>
      </div>                
    </div>
  </div>
</div>
@endsection