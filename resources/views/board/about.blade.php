@extends('layouts.base')

@section('content')

<link rel="stylesheet" href="css/about.css">

<title>About Us</title>

<!-- Header with Background Image -->

<header class="wccc-header text-center" oncontextmenu="return false;">
        <div>
        <h1 class="header-text">About us</h1>
        </div>
</header>

<!-- Page Content -->
<div class="container">

    <div class="row">
    <div class="col-sm-8">
        <h2 class="mt-4 about-title">History</h2>
        <p>In 2008 one of our local crags in Unaweep Canyon was being sold. The Access Fund, the national climbing advocacy group, approached our community, instilling the need for local representation of climbers. With the guidance of the AF, we started the process toward becoming a nonprofit corporation and attempted to purchase the threatened crag.  By the next year we had gained IRS 501c3 status and were under contract to secure the climbing and to plan a better trail and parking area. 
                Initially, we met at the Grand Junction Climbing Center and within the first year we had more than 80 members. The WCCC filled an instant need for organization to play an important stewardship role at local climbing areas, organizing trash cleanups and trail maintenance days, meeting with national park service and BLM personnel, and discussing threats to safe climbing and access, including private property issues surrounding the national monument and working on anchor replacements.
        </p>
    </div>
    <div class="col-sm-4">
        <h2 class="mt-4 about-title">Contact Us</h2>
        <address>   
        <strong>WCCC</strong>
        <br>261 East 200 South
        <br>Moab, Utah 84532
        <br>western_co_climbers@hotmail.com
        </address>
    </div>
    </div>

    <hr class="about-divider">

    <div class="container text-center">
        <h1 class="about-title">Members of the Board</h1>
        <p>The WCCC Board is comprised of an all-volunteer crew. We are busy with jobs and families and we love 
            to climb! Most Board business is conducted electronically to accommodate our schedules,
             and we meet in-person at least once a year. We host trail days and stewardship activities.</p>
    </div>

    @if(!Auth::guest())
    <div class="container text-center">
        <a href="/about/create" class="btn btn-primary my-2">Create</a>
    </div>
    @endif

    <div class="board">
    <!-- /.row -->
        @if(count($boardMembers) > 0)
        @foreach($boardMembers as $boardMember)
        <div class="row board-member">
            <div class="col-md-2" oncontextmenu="return false;">
                <img class="board-image" src="/storage/about_images/{{$boardMember->about_image}}" alt="">
            </div>
            <div class="col-md-10">
                <h2>{{$boardMember->name}}</h2>
                <p>{!!$boardMember->description!!}</p>
                <div class="d-flex justify-content-between align-items-center">   
                        @if(!Auth::guest())
                            <div class="btn-group"> 
                                <a class="btn btn-sm btn-outline-secondary" href="/about/{{$boardMember->id}}/edit">Edit</a>
                                {!!Form::open(['action' => ['BoardMembersController@destroy', $boardMember->id], 'method' => 'POST',])!!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Delete', ['class' => 'btn btn-danger btn-sm btn-outline-secondary'])}}
                                {!!Form::close()!!}
                            </div>
                        @endif
                    </div>
            </div>
        </div>
        @endforeach
        @else
        <p>No Members Found</p>
        @endif
       
        </div>

        <hr class="about-divider">

        <div class="press text-center">
            <div class="container text-center">
                <h1 class="about-title">Press</h1>
                {{-- <p>Press section description.</p> --}}
            </div>
            <div class="links">
            <ul>
            <li><h4><a style="color: darkslategrey;" href="https://www.accessfund.org/news-and-events/news/announcing-the-2016-sharp-end-awards">Eve Tallman wins the Sharp End Award</a></h4></li>
            <li><h4><a style="color: darkslategrey;" href="http://blog.theclymb.com/interviews/interview-with-garrett-mitchell-of-western-colorado-climbers-coalition/">Interview with Garrett Mitchell</a></h4></li>
            <li><h4><a style="color: darkslategrey;" href="https://www.postindependent.com/sports/outdoors/go-play-unaweep-canyon-cliffs-saved-for-climbing/">Post Independent Article about Unaweep Purchase</a></h4></li>
            <li><h4><a style="color: darkslategrey;" href="https://www.accessfund.org/news-and-events/news/western-colorado-climbers-coalition-pays-off-unaweep-canyon-loan">Payoff of Unaweep Canyon Loan</a></h4></li>
            <li><h4><a style="color: darkslategrey;" href="https://www.gjsentinel.com/news/western_colorado/pair-of-unaweep-cliffs-bought-to-preserve-access/article_f123ab5d-eced-51b8-b4b4-28dc7696cdb2.html">Pair of Unaweep cliffs bought to preserve access<a/><h4></li>
            </ul>
            </div>
        </div>

    </div>

@endsection