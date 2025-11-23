@extends('layouts.admin')
@section('title', 'Заявки')

@section('content')
    <x-admin.sidebar/>

    <div class="px-6 py-4 w-full">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-xl font-semibold text-gray-800">
                Тикеты
            </h1>
        </div>
        <form method="GET" class="flex gap-4 mb-6">

            <div>
                <label class="block text-sm mb-1">Статус</label>
                <select name="status" class="border-2 border-black rounded-2xl px-2 py-1">
                    <option value="">Все</option>
                    <option value="new" @selected(request('status') === 'new')>Новая</option>
                    <option value="in_work" @selected(request('status') === 'in_work')>В работе</option>
                    <option value="done" @selected(request('status') === 'done')>Готово</option>
                </select>
            </div>

            <div>
                <label class="block text-sm mb-1">Email</label>
                <input type="text" name="email" value="{{ request('email') }}" class="border-2 border-black rounded-2xl px-2 py-1">
            </div>

            <div>
                <label class="block text-sm mb-1">Телефон</label>
                <input type="text" name="phone" value="{{ request('phone') }}" class="border-2 border-black rounded-2xl px-2 py-1">
            </div>

            <div>
                <label class="block text-sm mb-1">С даты</label>
                <input type="date" name="from" value="{{ request('from') }}" class="border-2 border-black rounded-2xl px-2 py-1">
            </div>

            <div>
                <label class="block text-sm mb-1">По дату</label>
                <input type="date" name="to" value="{{ request('to') }}" class="border-2 border-black rounded-2xl px-2 py-1">
            </div>

            <div class="flex items-end">
                <button class="flex items-center rounded-lg bg-white px-3 py-1 text-black hover:bg-gray-100 border-2 border-black rounded-2xl">Фильтровать</button>
                <a href="{{route('admin.tickets.index')}}" class="ms-3 cursor-pointer flex items-center rounded-lg bg-white px-3 py-1 text-black hover:bg-gray-100 border-2 border-black rounded-2xl">Сбросить</a>
            </div>

        </form>

        <div class="overflow-x-auto rounded-xl border-2 border-black bg-white shadow-sm">
            <table class="min-w-full">
                <thead class="bg-gray-50 border-b-2 border-black">
                <tr>
                    <th scope="col" class="px-4 py-3 text-left text-xs uppercase text-black">
                        ID
                    </th>
                    <th scope="col" class="px-4 py-3 text-left text-xs uppercase text-black">
                        Тема
                    </th>
                    <th scope="col" class="px-4 py-3 text-left text-xs uppercase text-black">
                        Клиент
                    </th>
                    <th scope="col" class="px-4 py-3 text-left text-xs uppercase text-black">
                        Статус
                    </th>
                    <th scope="col" class="px-4 py-3 text-left text-xs uppercase text-black">
                        Создан
                    </th>
                    <th scope="col" class="px-4 py-3 text-left text-xs uppercase text-black">
                        Действия
                    </th>
                </tr>
                </thead>

                <tbody class="bg-white">
                @if($tickets->isNotEmpty())
                    @foreach($tickets as $ticket)
                        <tr class="border-b-2 border-black">
                            <td class="px-4 py-6 text-center text-sm text-black border-r-2 border-black">
                                {{$ticket->id}}
                            </td>
                            <td class="px-4 py-6 text-center text-sm text-black border-r-2 border-black">
                                {{$ticket->subject}}
                            </td>
                            <td class="px-4 py-6 text-center text-sm text-black border-r-2 border-black">
                                <div>{{$ticket->customer->name}}</div>
                                <div>{{$ticket->customer->email}}</div>
                                <div>{{$ticket->customer->phone}}</div>
                            </td>
                            <td class="px-4 py-6 text-center text-sm text-black border-r-2 border-black">
                                @php
                                    echo $ticket->status == 'new' ? 'Новая' : '';
                                    echo $ticket->status == 'in_work' ? 'В работе' : '';
                                    echo $ticket->status == 'done' ? 'Закрыта' : '';
                                @endphp
                            </td>
                            <td class="px-4 py-6 text-center text-sm text-black border-r-2 border-black">
                                {{$ticket->created_at}}
                            </td>
                            <td class="px-4 py-6 text-center text-sm text-black">
                                <a href="{{ route('admin.tickets.show', $ticket) }}" class="inline items-center rounded-lg bg-white px-3 py-1 text-black hover:bg-gray-100 border-2 border-black rounded-2xl">
                                    Открыть
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center font-bold text-black">
                            Тикетов пока нет
                        </td>
                    </tr>
                @endif
                </tbody>

            </table>
            {{ $tickets->links() }}
        </div>
    </div>

@endsection
