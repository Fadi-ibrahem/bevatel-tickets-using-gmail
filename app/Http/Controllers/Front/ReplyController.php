<?php

namespace App\Http\Controllers\Front;

use App\Events\ReplyMessageEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Front\Replies\StoreReplyRequest;
use App\Http\Requests\Front\Replies\UpdateReplyRequest;
use App\Interfaces\ReplyRepositoryInterface;
use App\Models\Reply;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ReplyController extends Controller
{
    /**
     * A property to hold the responsible repository for this controller
     * @var ReplyRepositoryInterface
     */
    private ReplyRepositoryInterface $replyRepo;

    /**
     * @param ReplyRepositoryInterface $replyRepo
     */
    public function __construct(ReplyRepositoryInterface $replyRepo)
    {
        $this->replyRepo = $replyRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get All Replies using ReplyRepository
        $replies = $this->replyRepo->index();

        return view('replies.index', compact('replies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $ticketID = $request->ticket_id;
        return view('replies.create', compact('ticketID'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReplyRequest $request)
    {
        // The data which will be stored as a new reply
        $data = $request->except(['_token']);

        // Create new reply record using ReplyRepository
        $this->replyRepo->store($data);

        // Add ticket's email to the data before triggering the event
        $data['email'] = Ticket::find($request->ticket_id)->email;

        // Trigger the event
        event(new ReplyMessageEvent($data));

        return redirect()->route('ticket.replies', $request->ticket_id)->with('success', 'Reply Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function show(Reply $reply, Request $request)
    {
        $ticketID = $request->ticket_id;

        return view('replies.show', compact(['reply', 'ticketID']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function edit(Reply $reply, Request $request)
    {
        $ticketID = $request->ticket_id;

        return view('replies.edit', compact(['reply', 'ticketID']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReplyRequest $request, Reply $reply)
    {
        // Update the specific reply using ReplyRepository
        $this->replyRepo->update($reply, $request->except(['_method', '_token']));

        return redirect()->route('ticket.replies', $reply->ticket_id)->with('success', 'Reply Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reply $reply)
    {
        // Delete the specific reply using ReplyRepository
        $this->replyRepo->destroy($reply);

        return redirect()->route('ticket.replies', $reply->ticket_id)->with('success', 'Reply Deleted Successfully!');
    }
}
