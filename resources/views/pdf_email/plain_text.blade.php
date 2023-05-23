<style type="text/css">
    body,
    td,
    th {
        font-family: verdana;
    }
</style>

<p>Dear Customer,<br /><br>
    Thank you for your recent enquiry. Please find attached our quotation attached. If you have any questions please do
    not hesitate to ask either by replying to this email or by calling our office number on 020 3004 4824.</p>
<p>Depending on your request and options available, you will see different prices in the PDF file. If you want to
    proceed, please make a payment to our bank account and put the quote as a reference number. <br>
    <br>
    We look forward to receiving your order and any future enquiries you may have. <br><br>
    For more information on the products and services available at ROKA please go to our website at
    furniturepaintspraying.co.uk<br /><br />

    Kind regards <br>
    ROKA Spraying
</p>

<div style="display: flex;">
    <button style="border-radius: 4px; color: #fff; background-color: #5bc0de; border: 1px solid #5bc0de; font-size: 14px;padding: 10px;font-family: 'Times New Roman', Times, serif; margin-right: 5px;">
        <a href="{{ route('approve_quote' , $id) }}"  style="color: #fff !important;">Approve Quote</a>
    </button>
    <button style="border-radius: 4px; color: #fff; background-color: #5bc0de; border: 1px solid #5bc0de; font-size: 14px;padding: 10px;font-family: 'Times New Roman', Times, serif;">
        <a href="{{ route('reject_quote', $id) }}" style="color: #fff !important;">Reject Quote</a>
    </button>
</div>
