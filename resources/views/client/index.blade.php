<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Client') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="w-full mx-auto sm:px-6 lg:px-8">


            <div class="bg-white">
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="border px-6 py-4">ID</th>
                            <th class="border px-6 py-4">Name</th>
                            <th class="border px-6 py-4">Type</th>
                            <th class="border px-6 py-4">Location</th>
                            <th class="border px-6 py-4">date</th>
                            <th class="border px-6 py-4">whatsapp</th>
                            <th class="border px-6 py-4">Email</th>
                            <th class="border px-6 py-4">Status</th>
                            <th class="border px-6 py-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($client as $item)
                        <tr>
                            <td class="border px-6 py-4">{{$item->id}}</td>
                            <td class="border px-6 py-4">{{$item->name}}</td>
                            <td class="border px-6 py-4">{{$item->type}}</td>
                            <td class="border px-6 py-4">{{$item->location}}</td>
                            <td class="border px-6 py-4">{{$item->date}}</td>
                            <td class="border px-6 py-4">{{$item->whatsapp}}</td>
                       
                            <td class="border px-6 py-4">{{$item->email}}</td>
                            <td class="border px-6 py-4">
                                
                            @if($item->status == 'Done')
                            <div class="inline-block bg-green-500 text-white font-bold py-2 px-1 mx-2 rounded w-2/3 text-center">
                            {{$item->status}}
                            </div>
                            @elseif($item->status == 'Deal')
                            <div class="inline-block bg-lime-500 text-white font-bold py-2 px-2 mx-2 rounded w-2/3 text-center">
                            {{$item->status}}    
                            </div>
                            @elseif($item->status == 'Reject')
                            <div class="inline-block bg-red-600 text-white font-bold py-2 px-2 mx-2 rounded w-2/3 text-center">
                            {{$item->status}}    
                            </div>
                            @elseif($item->status == 'OnProgress')
                            <div class="inline-block bg-amber-700 text-white font-bold py-2 px-2 mx-2 rounded w-2/3 text-center">
                            {{$item->status}}    
                            </div>
                            @elseif($item->status == 'Pending')
                            <div class="inline-block bg-amber-400 text-white font-bold py-2 px-2 mx-2 rounded w-2/3 text-center">
                            {{$item->status}}    
                            </div>
                            @elseif($item->status == 'new')
                            <div class="inline-block bg-gray-600 text-white font-bold py-2 px-2 mx-2 rounded w-2/3 text-center">  
                            {{$item->status}}    
                            </div>
                            @endif
                         
                        
                        
                        </td>
                            <td class="border px-6 py- text-center">
                                    <a href="{{ route('client.edit', $item->id) }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 mx-2 rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
  <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
</svg>
                                    </a>
                                    <form action="{{ route('client.destroy', $item->id) }}" method="POST" class="inline-block">
                                        {!! method_field('delete') . csrf_field() !!}
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-2 mx-2 rounded inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
  <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
</svg>
                                        </button>
                                    </form>
                                </td>
                        </tr>
                        @empty

                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="text-center mt-5">
            {{ $client->links()}}
        </div>
        </div>

    </div>
</x-app-layout>
