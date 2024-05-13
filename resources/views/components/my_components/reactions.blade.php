<!----grand coeur------->
<div class="container p-5">
<i id="bigHeart" class="bi bi-heart-fill text-danger fs-1" style="display: none;"></i>
<i id="bigHand" class="bi bi-hand-thumbs-up-fill text-primary fs-1" style="display: none;"></i>
<i id="bigHandTop" class="bi bi-hand-thumbs-down-fill text-primary fs-1" style="display: none;"></i>

<form id="heartForm" action="{{ route('immo.heart', ['id' => $immobilier->id]) }}" method="post">
    @csrf
    <!-- Hidden input fields to send immobilier_id and user_id -->
    <input type="hidden" name="immobilier_id" value="{{ $immobilier->id }}">
    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
    <button onclick="showBigHeart()" type="submit">
        <i class="bi bi-heart-fill text-danger"></i>
    </button>
</form>
<form id="dislikeForm"   action="{{ route('immo.dislike', ['id' => $immobilier->id]) }}" method="post">
    @csrf
    <!-- Hidden input fields to send immobilier_id and user_id -->
    <input type="hidden" name="immobilier_id" value="{{ $immobilier->id }}">
    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
    <button onclick="showBigHandTop()" type="submit">
        <i class="bi bi-hand-thumbs-down-fill text-primary"></i>
    </button>
</form>
<form id="likeForm"   action="{{ route('immo.like', ['id' => $immobilier->id]) }}" method="post">
    @csrf
    <!-- Hidden input fields to send immobilier_id and user_id -->
    <input type="hidden" name="immobilier_id" value="{{ $immobilier->id }}">
    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
    <button onclick="showBigHand()" type="submit">
        <i class="bi bi-hand-thumbs-up-fill text-primary"></i>
    </button>
</form>
</div>
<script>
    function showBigHeart() {
        // Affiche le grand cœur
        document.getElementById("bigHeart").style.display = "inline";
    }
    function showBigHandTop() {
        // Affiche le grand cœur
        document.getElementById("bigHandTop").style.display = "inline";
    }
    function showBigHand() {
        // Affiche le grand cœur
        document.getElementById("bigHand").style.display = "inline";
    }
</script>


<script>
    function effect(){
        document.getElementById("heartIcon").style.display = "inline";

    }
</script>