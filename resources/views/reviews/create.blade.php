@include('layouts.app')

@include('layouts.sidebar')

<div class="container mt-5">
    <h2 class="mb-4">إضافة تقييم للحرفي: {{ $artisan->user->name }}</h2>

    <!-- نموذج إضافة التقييم -->
    <form action="{{ route('reviews.store', $artisan->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="rating" class="form-label">التقييم (من 1 إلى 5)</label>
            <!-- النجوم -->
            <div class="stars" id="stars">
                <span class="star" data-value="1">&#9733;</span>
                <span class="star" data-value="2">&#9733;</span>
                <span class="star" data-value="3">&#9733;</span>
                <span class="star" data-value="4">&#9733;</span>
                <span class="star" data-value="5">&#9733;</span>
            </div>
            <input type="hidden" name="rating" id="rating" required>
        </div>
        <div class="mb-3">
            <label for="comment" class="form-label">تعليق (اختياري)</label>
            <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">إضافة التقييم</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // الجافاسكربت لتغيير التقييم بناءً على النقر على النجوم
    const stars = document.querySelectorAll('.star');
    const ratingInput = document.getElementById('rating');

    stars.forEach(star => {
        star.addEventListener('click', () => {
            const rating = star.getAttribute('data-value');
            ratingInput.value = rating;

            // تحديث شكل النجوم
            stars.forEach(s => {
                if (s.getAttribute('data-value') <= rating) {
                    s.classList.add('filled');
                } else {
                    s.classList.remove('filled');
                }
            });
        });
    });
</script>

<style>
    /* نمط النجوم */
    .stars {
        display: flex;
        justify-content: space-between;
        width: 150px;
        cursor: pointer;
    }

    .star {
        font-size: 60px;
        color: #ccc;
    }

    .star.filled {
        color: gold;
    }
</style>
</body>
</html>
