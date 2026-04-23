<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsletterSubscriber;

class NewsletterController extends Controller
{
    public function index()
    {
        return view('admin.newsletter.index');
    }

    public function toggle(NewsletterSubscriber $subscriber)
    {
        $subscriber->status = $subscriber->status === 'subscribed' ? 'unsubscribed' : 'subscribed';
        if ($subscriber->status === 'subscribed') {
            $subscriber->subscribed_at = now();
        } else {
            $subscriber->unsubscribed_at = now();
        }
        $subscriber->save();

        return back()->with('success', 'Subscriber status updated.');
    }

    public function destroy(NewsletterSubscriber $subscriber)
    {
        $subscriber->delete();
        return back()->with('success', 'Subscriber removed.');
    }
}
