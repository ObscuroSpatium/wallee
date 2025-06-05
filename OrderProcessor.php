<?php

class OrderProcessor {
    public function processOrders($orders):void {
        foreach ($orders as $order) {
            if ($order['status'] == 'pending') {
                $this->sendEmail($order);
            }
        }
    }

    private function getOrderTotal($order):float
    {
        $total = 0;

        if (!sizeof($order['items']))
            return $total;

        foreach ($order['items'] as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $this->calculateDiscount($order, $total);

        return $total;
    }

    private function calculateDiscount($order, &$total):void
    {
        if ($total > 100) {
            $total *= 1 - 0.1;
        }

        switch ($order['customer_type'])
        {
            case 'vip':
            {
                $total *= 0.9;
            }
            case 'regular':
            {
                $total *= 1;
            }
            default :
            {
                $total *= 1;
            }
        }
    }

    private function sendEmail($order):void {
        if ($total = $this->getOrderTotal($order)) {
            $message = 'Your total is ' . $total . '$';
            // Simulating email sending
            echo "Sending email to \"" . $order['customer_email'] . "\": $message\n";
        }
    }
}

$orders = [
    [
        'status' => 'pending',
        'customer_email' => 'customer1@example.com',
        'customer_type' => 'vip',
        'items' => [
            ['price' => 50, 'quantity' => 2],
            ['price' => 30, 'quantity' => 1]
        ]
    ],
    [
        'status' => 'completed',
        'customer_email' => 'customer2@example.com',
        'customer_type' => 'regular',
        'items' => [
            ['price' => 20, 'quantity' => 3]
        ]
    ]
];

$processor = new OrderProcessor();
$processor->processOrders($orders);
