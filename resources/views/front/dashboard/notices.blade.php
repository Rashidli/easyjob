@extends('front.layouts.master')

@section('title', 'Details')
@section('description', 'Details')
@section('keywords', 'Details')

<style>
    .sidebar-menu a.active {
        background-color: #10b981; /* emerald-500 */
        color: white;
        border-radius: 0.5rem; /* rounded-lg */
    }

    .sidebar-menu a:hover {
        background-color: #d1fae5; /* emerald-100 */
        color: #065f46; /* emerald-800 */
    }

    .vacancy-status {
        padding: 4px 8px;
        border-radius: 9999px;
        font-weight: 600;
    }

    .notice-item {
        padding: 12px 16px;
        border-radius: 8px;
        margin-bottom: 10px;
        transition: background-color 0.3s ease, transform 0.3s ease;
        cursor: pointer;
    }

    .notice-item.unread {
        background-color: #fef8d9; /* Light Yellow */
        border-left: 5px solid #ffb927; /* Highlight Color for Unread */
    }

    .notice-item.read {
        background-color: #e1e7f2; /* Light Blue */
        border-left: 5px solid #4e7df7; /* Highlight Color for Read */
    }

    .notice-item:hover {
        transform: scale(1.02);
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .notice-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #2c3e50;
    }

    .notice-body {
        font-size: 0.95rem;
        color: #7f8c8d;
    }

    .status-link {
        text-decoration: none;
        font-weight: 500;
        color: #2d9cdb;
    }

    .status-link:hover {
        text-decoration: underline;
    }
</style>

@section('content')

    <section class="relative mb:pb-24 pb-16 mt-30 z-1">
        <div class="container mt-12">
            <div class="grid md:grid-cols-12 grid-cols-1 gap-[30px]">
                <!-- Sidebar -->
                @include('front.includes.sidebar')

                <!-- Main Content -->
                <div class="lg:col-span-8 md:col-span-7">
                    <div class="p-6 rounded-md shadow-lg bg-white dark:bg-gray-800 mt-8">
                        <h5 class="text-2xl font-semibold mb-6">Bildirişlər</h5>

                        <!-- Notices -->
                        <div class="space-y-6">
                            @foreach($notices as $notice)
                                <div class="notice-item {{ $notice->is_read ? 'read' : 'unread' }}">
                                    <div class="flex justify-between">
                                        <div class="flex flex-col">
                                            <span class="notice-title">{{ $notice->vacancy_name }}</span>
                                            <p class="notice-body">{{ $notice->body }}</p>
                                        </div>
                                        <div class="vacancy-status">
                                            <a href="{{route('markAsRead', $notice->id)}}" class="status-link">{{ $notice->is_read ? 'Oxundu' : 'Oxu' }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div><!--end col-->
            </div><!--end grid-->
        </div><!--end container-->
    </section><!--end section-->

@endsection

<script>
    // function markAsRead(noticeId) {
    //     // Send an AJAX request to mark the notice as read
    //     fetch(`/company/notices/${noticeId}/mark-as-read`, {
    //         method: 'POST',
    //         headers: {
    //             'Content-Type': 'application/json',
    //             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    //         },
    //         body: JSON.stringify({
    //             _method: 'PATCH',
    //             id: noticeId,
    //         })
    //     })
    //         .then(response => response.json())
    //         .then(data => {
    //             // If successful, update the notice item to read
    //             const noticeItem = document.querySelector(`.notice-item[data-id="${noticeId}"]`);
    //             noticeItem.classList.remove('unread');
    //             noticeItem.classList.add('read');
    //         })
    //         .catch(error => console.error('Error marking as read:', error));
    // }
</script>
