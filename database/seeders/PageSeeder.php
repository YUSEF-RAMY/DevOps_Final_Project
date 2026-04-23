<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'title' => 'Help Center',
                'slug' => 'help-center',
                'content' => '<h2>Welcome to Our Help Center</h2>
<p>We are here to help you with any questions or concerns you may have. Below you will find answers to the most frequently asked questions.</p>

<h3>Frequently Asked Questions</h3>

<h4>How do I place an order?</h4>
<p>Placing an order is easy! Simply browse our products, add items to your cart, and proceed to checkout. You can pay using various payment methods including credit cards, PayPal, or Cash on Delivery.</p>

<h4>How can I track my order?</h4>
<p>Once your order is shipped, you will receive a tracking number via email. You can use this tracking number to monitor your package\'s journey to your doorstep.</p>

<h4>What if I forgot my password?</h4>
<p>Click on the "Forgot Password" link on the login page. Enter your email address and we\'ll send you instructions to reset your password.</p>

<h4>How do I update my account information?</h4>
<p>You can update your account information by logging into your account and visiting the Profile section. From there, you can edit your personal details, shipping addresses, and more.</p>

<h4>Do you offer international shipping?</h4>
<p>Currently, we ship to select countries. Please check our Shipping Info page for more details about shipping destinations and rates.</p>

<h3>Still Need Help?</h3>
<p>If you can\'t find the answer you\'re looking for, please don\'t hesitate to <a href="/page/contact-us">contact us</a>. Our customer service team is available to assist you.</p>',
                'meta_title' => 'Help Center - Frequently Asked Questions',
                'meta_description' => 'Find answers to frequently asked questions about ordering, shipping, returns, and more.',
                'meta_keywords' => 'help center, FAQ, customer support, questions, answers',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Shipping Info',
                'slug' => 'shipping-info',
                'content' => '<h2>Shipping Information</h2>
<p>We want to make sure your order arrives safely and on time. Here\'s everything you need to know about our shipping policies.</p>

<h3>Shipping Methods</h3>
<p>We offer several shipping options to meet your needs:</p>
<ul>
    <li><strong>Standard Shipping:</strong> 5-7 business days - Free on orders over $50</li>
    <li><strong>Express Shipping:</strong> 2-3 business days - $15.00</li>
    <li><strong>Overnight Shipping:</strong> Next business day - $25.00</li>
</ul>

<h3>Shipping Rates</h3>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Order Value</th>
            <th>Standard Shipping</th>
            <th>Express Shipping</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Under $50</td>
            <td>$5.99</td>
            <td>$15.00</td>
        </tr>
        <tr>
            <td>$50 - $100</td>
            <td>FREE</td>
            <td>$15.00</td>
        </tr>
        <tr>
            <td>Over $100</td>
            <td>FREE</td>
            <td>$10.00</td>
        </tr>
    </tbody>
</table>

<h3>Processing Time</h3>
<p>Orders are typically processed within 1-2 business days. During peak seasons or sales, processing may take up to 3 business days.</p>

<h3>International Shipping</h3>
<p>We currently ship to the following countries:</p>
<ul>
    <li>United States</li>
    <li>Canada</li>
    <li>United Kingdom</li>
    <li>Australia</li>
    <li>Select European countries</li>
</ul>
<p>International shipping rates vary by destination and are calculated at checkout.</p>

<h3>Order Tracking</h3>
<p>Once your order ships, you\'ll receive a tracking number via email. You can use this number to track your package on the carrier\'s website.</p>

<h3>Shipping Restrictions</h3>
<p>Some items may have shipping restrictions due to size, weight, or regulations. These restrictions will be noted on the product page.</p>

<h3>Questions?</h3>
<p>If you have any questions about shipping, please <a href="/page/contact-us">contact our customer service team</a>.</p>',
                'meta_title' => 'Shipping Information - Delivery Options & Rates',
                'meta_description' => 'Learn about our shipping methods, rates, processing times, and international shipping options.',
                'meta_keywords' => 'shipping, delivery, shipping rates, shipping methods, international shipping',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Returns',
                'slug' => 'returns',
                'content' => '<h2>Returns & Refunds Policy</h2>
<p>We want you to be completely satisfied with your purchase. If you\'re not happy with your order, we\'re here to help.</p>

<h3>Return Policy</h3>
<p>You have <strong>30 days</strong> from the date of delivery to return items for a full refund or exchange.</p>

<h3>Eligible Items</h3>
<p>Items must be:</p>
<ul>
    <li>Unused and in original condition</li>
    <li>In original packaging with all tags attached</li>
    <li>Accompanied by proof of purchase</li>
</ul>

<h3>Non-Returnable Items</h3>
<p>The following items cannot be returned:</p>
<ul>
    <li>Personalized or customized products</li>
    <li>Items damaged by misuse or normal wear</li>
    <li>Items without proof of purchase</li>
    <li>Digital products or downloadable content</li>
    <li>Gift cards</li>
</ul>

<h3>How to Return an Item</h3>
<ol>
    <li>Log into your account and go to "My Orders"</li>
    <li>Select the order containing the item you want to return</li>
    <li>Click "Request Return" and select the items</li>
    <li>Print the return label provided</li>
    <li>Package the item securely with the return label</li>
    <li>Drop off at any authorized carrier location</li>
</ol>

<h3>Return Shipping</h3>
<p>Return shipping costs are the responsibility of the customer unless the item was defective or incorrect. If you received a wrong or defective item, we\'ll cover the return shipping costs.</p>

<h3>Refund Process</h3>
<p>Once we receive your return:</p>
<ul>
    <li>We\'ll inspect the item within 2-3 business days</li>
    <li>If approved, your refund will be processed</li>
    <li>Refunds are issued to the original payment method</li>
    <li>You\'ll receive your refund within 5-10 business days</li>
</ul>

<h3>Exchanges</h3>
<p>We currently don\'t offer direct exchanges. To exchange an item:</p>
<ol>
    <li>Return the original item following the return process</li>
    <li>Place a new order for the item you want</li>
</ol>

<h3>Damaged or Defective Items</h3>
<p>If you receive a damaged or defective item, please contact us immediately. We\'ll arrange for a replacement or full refund, including return shipping costs.</p>

<h3>Questions?</h3>
<p>If you have questions about returns or need assistance, please <a href="/page/contact-us">contact us</a>. Our customer service team is happy to help!</p>',
                'meta_title' => 'Returns & Refunds Policy - Easy Returns',
                'meta_description' => 'Learn about our return policy, how to return items, refund process, and return shipping information.',
                'meta_keywords' => 'returns, refunds, return policy, exchange, return shipping',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Contact Us',
                'slug' => 'contact-us',
                'content' => '<h2>Get in Touch</h2>
<p>We\'d love to hear from you! Whether you have a question, feedback, or need assistance, our team is here to help.</p>

<h3>Contact Information</h3>
<div class="row">
    <div class="col-md-6">
        <h4><i class="bi bi-envelope"></i> Email</h4>
        <p>For general inquiries: <a href="mailto:support@example.com">support@example.com</a></p>
        <p>For business inquiries: <a href="mailto:business@example.com">business@example.com</a></p>
    </div>
    <div class="col-md-6">
        <h4><i class="bi bi-telephone"></i> Phone</h4>
        <p>Customer Service: <strong>1-800-123-4567</strong></p>
        <p>Hours: Monday - Friday, 9:00 AM - 6:00 PM EST</p>
    </div>
</div>

<h3>Office Address</h3>
<p>
    <strong>eCommerce Store</strong><br>
    123 Commerce Street<br>
    Business City, BC 12345<br>
    United States
</p>

<h3>Response Time</h3>
<p>We aim to respond to all inquiries within 24-48 hours during business days. For urgent matters, please call our customer service line.</p>

<h3>Social Media</h3>
<p>Follow us on social media for updates, promotions, and more:</p>
<ul>
    <li><strong>Facebook:</strong> <a href="#" target="_blank">@ecommercestore</a></li>
    <li><strong>Twitter:</strong> <a href="#" target="_blank">@ecommercestore</a></li>
    <li><strong>Instagram:</strong> <a href="#" target="_blank">@ecommercestore</a></li>
    <li><strong>LinkedIn:</strong> <a href="#" target="_blank">eCommerce Store</a></li>
</ul>

<h3>Frequently Asked Questions</h3>
<p>Before contacting us, you might find the answer in our <a href="/page/help-center">Help Center</a> or <a href="/page/shipping-info">Shipping Info</a> pages.</p>

<h3>Feedback</h3>
<p>We value your feedback! If you have suggestions on how we can improve our service, please don\'t hesitate to reach out. Your input helps us serve you better.</p>',
                'meta_title' => 'Contact Us - Get in Touch',
                'meta_description' => 'Contact our customer service team via email, phone, or visit our office. We\'re here to help!',
                'meta_keywords' => 'contact, customer service, support, email, phone, address',
                'is_active' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($pages as $pageData) {
            Page::updateOrCreate(
                ['slug' => $pageData['slug']],
                $pageData
            );
        }

        $this->command->info('Pages seeded successfully!');
    }
}
