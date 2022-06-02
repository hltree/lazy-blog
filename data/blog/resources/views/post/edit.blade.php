@extends('layouts.app')
@section('content')
    <input name="post_title" class="post_title-input" id="post_title" placeholder="タイトルを入力セイ" type="text" />
    <div id="editor"></div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const submit = document.getElementById('form-md-editor-submit')

            if (submit) {
                submit.addEventListener('click', function () {
                    Swal.fire({
                        title: '確認',
                        text: "送信します。よろしいですか？",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: '送信',
                        preConfirm: function () {
                            const postTitle = document.getElementById('post_title')
                            const formData = new FormData(document.getElementById('form-md-editor'))

                            formData.append('post_title', postTitle.value)

                            if (!formData.get('post_title') || !formData.get('post_content') ) {
                                Swal.showValidationMessage(
                                    `{{ __('タイトルとコンテンツは必須項目です') }}`
                                )
                                return;
                            }

                            fetch('{{ $actionRoute }}', {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
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
                                        title: `{{ __('保存しました') }}`,
                                        showCancelButton: false,
                                        showConfirmButton: false
                                    })

                                    window.location.assign(json.url)
                                }
                            })
                        }
                    })
                })
            }
        })
    </script>
@endsection
