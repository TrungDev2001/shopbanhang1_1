@foreach ($contact_customers as $contact_customer)
    <tr>
        <td>{{ $contact_customer->id }}</td>
        <td>{{ $contact_customer->name_customer }}</td>
        <td>{{ $contact_customer->email_customer }}</td>
        <td>{{ $contact_customer->subject_customer }}</td>
        <td>{{ $contact_customer->content_customer }}</td>
        @if ($contact_customer->status == 0)
            <!-- Button trigger modal -->
            <td class="contact_customer_{{ $contact_customer->id }}">
                <button type="button" class="btn btn-primary btn-model_contact_customer" data-contact_customer_id="{{ $contact_customer->id }}" data-toggle="modal" data-target="#model_contact_customer">
                    Trả lời
                </button>
            </td>
        @else
            <td aria-disabled="true">Đã trả lời</td>
        @endif
        <td>{{ date_format($contact_customer->created_at, 'd-m-Y') }}</td>
        <td>
            <a>
                {{-- <i data-url="Video/edit/{{ $contact_customer->id }}" data-toggle="modal" data-target="#editVideoModal" class="fa fa-pencil-square-o text-success text-active edit-form"></i> --}}
                @can('contact-delete')
                    <i data-url="/contact/destroy/{{ $contact_customer->id }}" class="fa fa-times text-danger text delete-sweetalert"></i>
                @endcan
            </a>
        </td>
    </tr>
@endforeach

<!-- Modal -->
<div class="modal fade" id="model_contact_customer" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Trả lời email</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div style="display: flex; justify-content: space-between;">
                <p>Shop</p>
                <p>Gửi tới</p>
                <p id="email_customer"></p>
            </div>
            <hr>
            <p>Subject: <span id="subject_customer"></span></p>
            <p>Message: <span id="content_customer"></span></p>
            <hr>
            <p>Trả lời:</p>
            <form action="" id="form_reply_contact" method="POST" enctype="multipart/form-data">
                <textarea name="reply_contact" id="" cols="68" rows="10"></textarea>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary btn-reply" data-contact_customer_id="" data-dismiss="modal">Trả lời</button>
        </div>
        </div>
    </div>
</div>

<script>

</script>