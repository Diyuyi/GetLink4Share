<x-layout>
    <div class="container">
        <form action="{{route('FourShareLinks.index')}}" method="GET">
            @csrf
            <div class="mb-3">
                <label for="fourshare_url" class="form-label">4Share Link/FileID
                </label>
                <input type="text" class="form-control" id="fourshare_url" name="fourshare_url">
            </div>
            <button type="submit" class="btn btn-primary">Send</button>
        </form>
    </div>
</x-layout>