 @can ('accept', $model)
    <a title="Mark this answer as best answer" 
        class="{{ $model->status }} my-2"
        onclick="event.preventDefault(); document.getElementById('accept-answer-{{ $model->id }}').submit();"
        >
        <i class="fas fa-check fa-2x"></i>
    </a>
    <form id="accept-answer-{{ $model->id }}" action="{{ route('answers.accept', $model->id)}}" method="POST" style="display:none;">
        @csrf
    </form>
@else
    @if ($model->isBest)
        <a title="The question owner accepted this answer as best answer" class="{{ $model->status }} my-2">
            <i class="fas fa-check fa-2x"></i>
        </a>
    @endif
@endcan