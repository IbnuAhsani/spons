<?php

namespace App\Http\Controllers;

use Auth;

use App\Company;
use App\Constant;
use App\Event;
use App\EventCategory;
use App\EventType;
use App\Event_User;
use App\GrantType;
use App\StudentIndividual;
use App\StudentOrganization;
use App\User;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function landingPage(){
        return view('pages.landing');
    }

    public function signInPage(){
        return view('pages.signIn');
    }

    public function studentRegisterPage(){
        return view('pages.studentRegister');
    }

    public function companyRegisterPage(){
        return view('pages.companyRegister');
    }

    public function eventsPage(){
        $events = Event::orderBy('created_at', 'desc')->paginate(6);
        $firstEventIndex = $events->firstItem();

        return view('pages.events')->with(compact('events', 'firstEventIndex'));
    }

    public function eventDetailPage($eventId){
        $event = Event::find($eventId);
        $userDataEmail = $event->user->email;

        return view('pages.eventDetail')->with(compact('event', 'userDataEmail'));
    }

    public function companiesPage(){
        $companies = User::where('role', Constant::ROLE_COMPANY)->with(['company'])->paginate(6);
        $firstCompanyIndex = $companies->firstItem();

        return view('pages.companies')->with(compact('companies', 'firstCompanyIndex'));
    }

    public function companyDetailPage($companyId){
        $companyUser = User::find($companyId);
        $companyData = $companyUser->company;
        $user = Auth::user();

        if($user !== null && ($user->role == Constant::ROLE_STUDENT_INDIVIDUAL || $user->role == Constant::ROLE_STUDENT_ORGANIZATION)){
            $events = $user->studentEvents;
            $submittedEvents = Event_User::where([
                ['student_id', '=', $user->id],
                ['user_id', '=', $companyId],
            ])->get();

            foreach($events as $i => $event){
                foreach($submittedEvents as $submittedEvent){
                    if($event->id == $submittedEvent->event_id){
                        unset($events[$i]);
                    }
                }
            }

            return view('pages.companyDetail')->with(compact('companyUser', 'companyData', 'events'));
        }

        return view('pages.companyDetail')->with(compact('companyUser', 'companyData'));
    }

    public function profilePage(){
        $user = Auth::user();

        if($user->role == Constant::ROLE_STUDENT_INDIVIDUAL || $user->role == Constant::ROLE_STUDENT_ORGANIZATION){

            if($user->role == Constant::ROLE_STUDENT_INDIVIDUAL){
                $userData = $user->studentIndividual;
            } else if($user->role == Constant::ROLE_STUDENT_ORGANIZATION){
                $userData = $user->studentOrganization;
            }

            $events = $user->studentEvents()->paginate(6);
            return view('pages.profile')->with(compact('userData','events'));
        }

        if($user->role == Constant::ROLE_COMPANY){

            $userData = $user->company;
            return view('pages.profile')->with('userData', $userData);
        }

        return redirect('errorPage');
    }

    public function createEventPage(){
        $eventCategories = EventCategory::all();
        $eventTypes = EventType::all();
        $user = Auth::user();

        if(Auth::user()->role == Constant::ROLE_STUDENT_INDIVIDUAL){
            $userData = $user->studentIndividual;
        } else if(Auth::user()->role == Constant::ROLE_STUDENT_ORGANIZATION){
            $userData = $user->studentOrganization;
        }

        return view('pages.createEvent')->with(compact('userData', 'eventTypes', 'eventCategories'));
    }

    public function createGrantPage(){
        $grantTypes = GrantType::all();
        $userData = Auth::user()->company;

        return view('pages.createGrant')->with(compact('userData', 'grantTypes'));
    }

    public function transactionsPage(){
        $user = Auth::user();

        if($user->role == Constant::ROLE_STUDENT_INDIVIDUAL || $user->role == Constant::ROLE_STUDENT_ORGANIZATION){

            if($user->role == Constant::ROLE_STUDENT_INDIVIDUAL){
                $userData = $user->studentIndividual;
            } else if($user->role == Constant::ROLE_STUDENT_ORGANIZATION){
                $userData = $user->studentOrganization;
            }

            $transactions = Event_User::whereIn('student_confirmation_status',
                [Constant::SPONSORSHIP_REQUEST_ACCEPTED, Constant::SPONSORSHIP_REQUEST_REJECTED])
                ->paginate(6);

            $events = [];

            foreach($transactions as $i => $transaction){
                $events[$i] = Event::find($transaction->event_id);
            }

            return view('pages.transactions')->with(compact('userData', 'transactions', 'events'));
        }

        if($user->role == Constant::ROLE_COMPANY){

            $userData = $user->company;

            $transactions = Event_User::whereIn('company_confirmation_status',
                [Constant::SPONSORSHIP_REQUEST_ACCEPTED, Constant::SPONSORSHIP_REQUEST_REJECTED])
                ->paginate(6);

            $events = [];

            foreach($transactions as $i => $transaction){
                $events[$i] = Event::find($transaction->event_id);
            }

            return view('pages.transactions')->with(compact('userData', 'transactions', 'events'));
        }

        return redirect('errorPage');
    }

    public function sponsorshipRequestsPage(){
        $user = Auth::user();

        if($user->role == Constant::ROLE_COMPANY){
            $userData = $user->company;

            $sponsorshipRequests = Event_User::where([
                ['company_confirmation_status', '=', Constant::SPONSORSHIP_REQUEST_PENDING],
                ['user_id', '=', $user->id],
            ])->paginate(6);

            $events = [];

            foreach($sponsorshipRequests as $i => $sponsorshipRequest){
                $events[$i] = Event::find($sponsorshipRequest->event_id);
            }

            return view('pages.sponsorshipRequests')->with(compact('userData', 'sponsorshipRequests', 'events'));
        }

        return redirect('errorPage');
    }
}
