<style type="text/css">
    body,
    td,
    th {
        font-family: verdana;
    }
    .hidden {
        display: none !important;
    }
</style>

<p>Dear Customer,</p>
<p>Thank you for your recent enquiry. Please find our quotation attached. If you have any questions please do not hesitate to either reply to this email or call our office on 020 3004 4824. Alternatively email us at office@roka-spray.com. </p>
<p>Your quotation has been based upon the information provided, and each item has been priced according to your request and the recommended options available. Please thoroughly check the paint colours match the specification you require. Please also make a note of our Terms and Conditions of business, which are listed below our quotation. Placing your order with us is an acceptance of our terms and conditions. </p>
<p>If you would like to proceed, please confirm via email. If your order is under £500, please make payment in full via bank transfer. Our account details are listed below. If your order is over £500, please make a 50% deposit payment to our bank account. In either case, please put the quote number as a reference number for your payment. For credit card payments, please call our office. </p>
<p>We look forward to receiving your order and any future enquiries you may have. For further information on the products and services available at ROKA Spray, please visit our website at www.ROKA-spray.com. </p>
<p>Kind regards, </p>
<p>ROKA Spray Team<br>
  Office@roka-spray.com<br>
  T: 02030044824</p>

<p>Payment Details:<br>
  Account name: RBC LONDON LLP<br>
  Sort Code: 60-70-05<br>
  Account number: 50583654</p>

<div style="display: flex;" id="btn-div">
    <button style="border-radius: 4px; color: #fff; background-color: #5bc0de; border: 1px solid #5bc0de; font-size: 14px;padding: 10px;font-family: 'Times New Roman', Times, serif; margin-right: 5px;">
        <a href="{{ route('approve_quote', ['id' => $id, 'admin_email' => $admin_email]) }}"  style="color: #fff !important;">Approve Quote</a>
    </button>
    <button style="border-radius: 4px; color: #fff; background-color: #5bc0de; border: 1px solid #5bc0de; font-size: 14px;padding: 10px;font-family: 'Times New Roman', Times, serif;">
        <a href="{{ route('reject_quote', ['id' => $id, 'admin_email' => $admin_email]) }}" style="color: #fff !important;">Reject Quote</a>
    </button>
</div>
