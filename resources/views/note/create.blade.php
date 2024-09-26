
<x-app-layout>
    <div class="note-continer single-note py-12">
        <h1>Cretae New Note </h1>
        <form action="{{ route('note.store')}}" method="POST" class="note">

            @csrf
            <textarea name="note" class="note-body"  rows="10" placeholder="Enter Your Note Here"></textarea>

            <div class="note-buttons">
                <a href="{{ route('note.index')}}" class="note-cancel-button"> Cancle</a>
                <button class="note-submit-button">Submit</button>
            </div>
        </form>
    </div>
</x-app-layout>