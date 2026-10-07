@extends('admin.include.layout')
@section('heading', 'Products')
@section('title', 'Products List')


@section('content')
    <div class="max-w-7xl mx-auto bg-white shadow-lg rounded-2xl p-8 mt-8 border border-gray-100">
        <div class="flex flex-col sm:flex-row justify-between sm:items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-3 sm:mb-0">OrderRequest Lists</h1>
        </div>


        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('sms'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-800 p-3 rounded mb-4">
                {{ session('sms') }}
            </div>
        @endif

        <!-- Table -->
        <div class="overflow-x-auto border border-gray-200 rounded-lg">
            <table class="min-w-full text-sm text-left text-gray-700">
                <thead class="bg-gray-50 uppercase text-gray-700 font-semibold">
                    <tr>
                        <th class="px-5 py-3 border-b">#</th>
                        <th class="px-5 py-3 border-b"> Customer Name</th>
                        <th class="px-5 py-3 border-b">Phone</th>
                        <th class="px-5 py-3 border-b">Material</th>
                        <th class="px-5 py-3 border-b">File</th>
                        <th class="px-5 py-3 border-b">Desting</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($custom as $data)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-5 py-3 border-b">{{ $loop->iteration }}</td>
                            <td class="px-5 py-3 border-b font-medium">{{ $data->name }}</td>
                            <td class="px-5 py-3 border-b">{{ $data->contact }}</td>
                            <td class="px-5 py-3 border-b">{{ $data->material }}</td>
                            <td class="px-5 py-3 border-b">
                                  <img src="{{ asset($data->images) }}" alt="" width="40px">
                            </td>
                            <td class="px-5 py-3 border-b">{{ $data->description }}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6 flex justify-end">
            {{ $custom->links() }}
        </div>
    </div>
@endsection
