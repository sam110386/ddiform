@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row p-4">
        <div class="col-md-12 text-center">
            <h1>Know your Audience Better, <br/>One Question at a Time</h1>
            <p class="text-blue-grey mb-3 font-17">
                Embed your question and start collecting responses.
            </p>
            <div class="col-md-12">
                <center>
                    @guest
                    <a href="{{ route('login') }}" class=" btn btn-lg btn-light-blue-solid" style="margin-bottom: 10px;">Start Asking</a>
                    @else
                    <a href="{{ route('new-form') }}" class=" btn btn-lg btn-light-blue-solid" style="margin-bottom: 10px;">Start Asking</a>
                    @endguest
                    
                </center>
            </div>
            <div class="col-md-8 col-md-offset-2">
                <img src="{{asset('img/flow.gif')}}" class="img-responsive" alt="DDI Forms" />
            </div>
        </div>
    </div>
    <div class="row pb-40 mtb-5">
        <div class="col-md-3">
            <div class="feature text-center">
                <i class="ion-android-list"></i>
                <h3>Embed</h3>
                <span class="text-blue-grey">
                    Just copy & paste link and we handle rest
                </span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="feature text-center">
                <i class="ion-stats-bars"></i>
                <h3>View Statistics</h3>
                <span class="text-blue-grey">
                    View stastics visualization of responses
                </span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="feature text-center">
                <i class="ion-email"></i>
                <h3>Generate Leads</h3>
                <span class="text-blue-grey">
                    Collect leads and export them
                </span>
            </div>
        </div>   
        <div class="col-md-3">
            <div class="feature text-center">
                <i class="ion-outlet"></i>
                <h3>Integrate</h3>
                <span class="text-blue-grey">
                    Integrate with Convertkit and other great stuff
                </span>
            </div>
        </div>
                             
    </div>
</div>

<div class="row">
    <div class="container text-center">
        <h3>Integrate these awesome services...</h3>
        <div class="col-md-3">
            <div class="integrate">
                <img width="50" class="" src="{{asset('img/mailchimp.png')}}" />
                <h4>MailChimp</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="integrate">
                <img width="50" class="" src="{{asset('img/googlesheets.png')}}" />
                <h4>Google Sheets</h4>
            </div>
        </div>
        <!--div class="col-md-3">
            <div class="integrate">
                <img width="50" class="" src="{{asset('img/zapier.png')}}" />
                <h4>Zapier</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="integrate">
                <img width="50" class="" src="{{asset('img/slack.png')}}" />
                <h4>Slack</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="integrate">
                <img width="50" class="" src="{{asset('img/aweber.png')}}" />
                <h4>AWeber</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="integrate">
                <img width="50" class="" src="{{asset('img/sendgrid.png')}}" />
                <h4>SendGrid</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="integrate">
                <img width="50" class="" src="{{asset('img/drip.png')}}" />
                <h4>Drip</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="integrate">
                <img width="50" class="" src="{{asset('img/revue.png')}}" />
                <h4>Revue</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="integrate">
                <img width="50" class="" src="{{asset('img/hubspot.png')}}" />
                <h4>HubSpot</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="integrate">
                <img width="50" class="" src="{{asset('img/sendinblue.png')}}" />
                <h4>SendInBlue</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="integrate">
                <img width="50" class="" src="{{asset('img/madmimi.png')}}" />
                <h4>Mad Mimi</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="integrate">
                <img width="50" class="" src="{{asset('img/constantcontact.png')}}" />
                <h4>Constant Contact</h4>
            </div>
        </div-->
        <div class="col-md-3">
            <div class="integrate">
                <img width="50" class="" src="{{asset('img/convertkit.png')}}" />
                <h4>ConvertKit</h4>
            </div>
        </div>
        <!--div class="col-md-3">
            <div class="integrate">
                <img width="50" class="" src="{{asset('img/sendx.png')}}" />
                <h4>SendX</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="integrate">
                <img width="50" class="" src="{{asset('img/campaignmonitor.png')}}" />
                <h4>Campaign Monitor</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="integrate">
                <img width="50" class="" src="{{asset('img/emailoctopus.png')}}" />
                <h4>EmailOctopus</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="integrate">
                <img width="50" class="" src="{{asset('img/getresponse.png')}}" />
                <h4>GetResponse</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="integrate">
                <img width="50" class="" src="{{asset('img/goodbits.png')}}" />
                <h4>Goodbits</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="integrate">
                <img width="50" class="" src="{{asset('img/mailerlite.png')}}" />
                <h4>MailerLite</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="integrate">
                <img width="50" class="" src="{{asset('img/kickofflabs.png')}}" />
                <h4>Kickoff Labs</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="integrate">
                <img width="50" class="" src="{{asset('img/salesforcemarketingcloud.png')}}" />
                <h4>Salesforce Marketing Cloud</h4>
            </div>
        </div-->
    </div>
</div>
@endsection
