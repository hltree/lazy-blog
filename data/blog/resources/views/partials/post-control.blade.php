@auth
    @if ('post.newPost' !== Route::currentRouteName())
        <nav class="post-control navbar navbar-expand-md navbar-light bg-white rounded">
            <div class="container">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            @if ('post.edit' !== Route::currentRouteName())
                                <a class="btn btn-primary" href="{{ route('post.edit', ['id' => $id]) }}">
                                    {{ __('Edit') }}
                                </a>
                            @endif
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary" id="delete-post-button" href="#">
                                {{ __('Delete') }}
                            </a>

                            <form id="delete-post" action="{{ route('post.delete', ['id' => $id]) }}" method="POST"
                                  class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const btn = document.getElementById('delete-post-button')
                const target = document.getElementById('delete-post')

                if (btn && target) {
                    btn.addEventListener('click', function () {
                        Swal.fire({
                            title: '確認',
                            text: "削除します。よろしいですか？",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: '送信'
                        }).then(function (r) {
                            if (false === r.isConfirmed) return;

                            const formData = new FormData(target)

                            return fetch('{{ route('post.delete', ['id' => $id]) }}', {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                            })
                        }).then(function (response) {
                            return response.json()
                        }).then(function (json) {
                            if (undefined !== json.errors) {
                                const entries = Object.entries(json.errors)
                                Swal.fire({
                                    title: entries[0][1]
                                })
                            } else {
                                Swal.fire({
                                    title: `{{ __('削除しました') }}`,
                                    showCancelButton: false,
                                    showConfirmButton: false
                                })

                                window.location.assign(json.url)
                            }
                        })
                    })
                }
            })
        </script>
    @endif
@endauth
