@extends('layouts.admin')
@section('title', 'Заявка')

@section('content')
    <x-admin.sidebar/>

    <div class="px-6 py-4 w-full">
        <div class="py-8">
            <div class="flex justify-between mb-4 items-center">
                <div class="">
                    <a href="{{ route('admin.tickets.index') }}" class="inline items-center rounded-lg bg-white px-3 py-1 text-black hover:bg-gray-100 border-2 border-black rounded-2xl">
                        Назад к списку
                    </a>
                </div>
                <div class="flex items-end">
                    @if (session('success'))
                        <div class="inline mb-2 rounded-lg px-4 py-3 font-bold text-green-800">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('admin.tickets.update-status', $ticket) }}">
                        @csrf
                        @method('PATCH')

                        <label class="block font-bold text-black mb-1">
                            Статус заявки
                        </label>

                        <select name="status" class="inline items-center rounded-lg bg-white px-3 py-1 text-black hover:bg-gray-100 border-2 border-black rounded-2xl" onchange="this.form.submit()">

                            <option value="new" @selected($ticket->status === 'new')>
                                Новая
                            </option>

                            <option value="in_work" @selected($ticket->status === 'in_work')>
                                В работе
                            </option>

                            <option value="done" @selected($ticket->status === 'done')>
                                Закрыта
                            </option>
                        </select>
                    </form>

                </div>
            </div>
            <div class="bg-white border-black border-2 rounded-xl">
                <div class="flex items-start justify-between mb-4 border-b-2 border-black w-full">
                    <div class="p-6">
                        <h1 class="text-xl text-black">
                            Заявка № {{ $ticket->id }} - {{ $ticket->subject }}
                        </h1>
                        <p class="text-black mt-1">
                            Создано: {{ $ticket->created_at->format('Y-m-d H:i') }}
                        </p>
                    </div>
                </div>

                    <div class="mb-6 border-black border-b-2 pb-3">
                        <div class="p-6">
                            <h2 class="font-bold text-black mb-1 text-xl">Клиент</h2>
                            <div class="text-black">
                                <div>{{ $ticket->customer->name }}</div>
                                @if($ticket->customer->email)
                                    <div class="text-black">Email: {{ $ticket->customer->email }}</div>
                                @endif
                                @if($ticket->customer->phone)
                                    <div class="text-black">Телефон: {{ $ticket->customer->phone }}</div>
                                @endif
                            </div>
                        </div>
                    </div>

                <div class="mb-6">
                    <div class="p-6 pt-0">
                        <h2 class="text-black text-xl font-bold">Сообщение</h2>
                        <div class="text-black">
                            {{ $ticket->text }}
                        </div>
                    </div>
                </div>

                @if($ticket->getMedia('ticket_file')->isNotEmpty())
                    <div class="mb-4 p-6 pt-0 border-black border-t-2">
                        <h2 class="font-bold text-black text-xl mb-1 pt-5">Файл</h2>
                            @foreach($ticket->getMedia('ticket_file') as $file)
                                <a href="{{ $file->getUrl() }}" download class="text-indigo-600 hover:underline">
                                    {{ $file->file_name }}
                                </a>
                                <div class="mt-3">
                                    <a href="{{ $file->getUrl() }}" download class="inline items-center rounded-lg bg-white px-3 py-1 text-black hover:bg-gray-100 border-2 border-black rounded-2xl">
                                        Скачать файл
                                    </a>
                                </div>
                            @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
