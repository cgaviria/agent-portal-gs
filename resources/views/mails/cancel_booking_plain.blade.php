A request has been made to cancel the following booking:

ID: {{$booking->id}}
Order ID: {{($booking->order_id ? $booking->order_id : 'N/A')}}
Product Name: {{($booking->product_name ? $booking->product_name : 'N/A')}}
Port: {{($booking->port ? $booking->port : 'N/A')}}
Tour Date: {{($booking->tour_date ? date('n/j/Y', strtotime($booking->tour_date)) : 'N/A')}}
Tour Time: {{($booking->tour_time ? $booking->tour_time : 'N/A')}}

Thank You,
Shore Excursions Group