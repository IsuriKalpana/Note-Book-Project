<x-app-layout>
    <div class="note-continer single-note">
        
        <div class="note-header">
            <h1 class="text-3xl py-4">
                Note : {{  $note->created_at }}
            </h1>
            <div class="note-buttons">
                <a href="{{ route('note.edit', $note) }}" class="note-edit-button"> EDIT</a>
                <form action="{{ route('note.destroy', $note)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="note-delete-button">DELETE</button>
                </form>
            </div>
        </div>

        <div class="note">
            <div class="note-body">

                {{  $note->note  }}

            </div>
        </div>
     </div>
</x-app-layout>