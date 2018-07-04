A request has been made to cancel the following booking:

<div>
    <p><b>ID:</b>&nbsp;{{$booking->id}}</p>
    <p><b>Order ID:</b>&nbsp;{{($booking->order_id ? $booking->order_id : 'N/A')}}</p>
    <p><b>Product Name:</b>&nbsp;{{($booking->product_name ? $booking->product_name : 'N/A')}}</p>
    <p><b>Port:</b>&nbsp;{{($booking->port ? $booking->port : 'N/A')}}</p>
    <p><b>Tour Date:</b>&nbsp;{{($booking->tour_date ? date('n/j/Y', strtotime($booking->tour_date)) : 'N/A')}}</p>
    <p><b>Tour Time:</b>&nbsp;{{($booking->tour_time ? $booking->tour_time : 'N/A')}}</p>
</div>

Request was made by:

<div>
    <p><b>User ID:</b>&nbsp;{{$user->id}}</p>
    <p><b>First Name:</b>&nbsp;{{($user->first_name)}}</p>
    <p><b>Last Name:</b>&nbsp;{{($user->last_name)}}</p>
    <p><b>Email:</b>&nbsp;{{($user->email)}}</p>
</div>

Thank You,
<br/>
<i>Shore Excursions Group Team</i>