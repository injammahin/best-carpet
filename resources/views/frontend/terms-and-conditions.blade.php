@extends('layouts.frontend')

@section('title', 'Terms and Conditions | Mega Carpets')
@section('meta_description', 'Read the Mega Carpets website terms and conditions, including quotes, product information, installation, warranties, payments and consumer rights.')

@section('content')

    <style>
        .legal-hero {
            background: #f8f3ed;
            border-bottom: 1px solid #eadfd6;
        }

        .legal-wrap {
            max-width: 980px;
            margin: 0 auto;
        }

        .legal-card {
            border: 1px solid #eadfd6;
            background: #ffffff;
            border-radius: 7px;
            padding: 34px;
            box-shadow: 0 24px 70px rgba(7, 7, 7, 0.05);
        }

        .legal-content {
            color: #5f5964;
            font-size: 16px;
            font-weight: 600;
            line-height: 1.85;
        }

        .legal-content h2 {
            margin-top: 36px;
            margin-bottom: 12px;
            color: #070707;
            font-size: 28px;
            font-weight: 950;
            line-height: 1.15;
            letter-spacing: -0.045em;
        }

        .legal-content h2:first-child {
            margin-top: 0;
        }

        .legal-content p {
            margin-top: 12px;
        }

        .legal-content ul {
            margin-top: 14px;
            display: grid;
            gap: 10px;
            padding-left: 0;
            list-style: none;
        }

        .legal-content li {
            position: relative;
            padding-left: 30px;
        }

        .legal-content li::before {
            content: "✓";
            position: absolute;
            left: 0;
            top: 2px;
            display: grid;
            width: 20px;
            height: 20px;
            place-items: center;
            border-radius: 999px;
            background: #fff3ec;
            color: #ff5a00;
            font-size: 11px;
            font-weight: 950;
        }

        .legal-note {
            border: 1px solid rgba(255, 90, 0, 0.24);
            background: #fff7f1;
            border-radius: 7px;
            padding: 22px;
        }

        .legal-note strong {
            color: #070707;
        }

        @media (max-width: 640px) {
            .legal-card {
                padding: 24px;
            }

            .legal-content h2 {
                font-size: 24px;
            }
        }
    </style>

    <section class="legal-hero py-14 md:py-20">
        <div class="site-container">
            <div class="legal-wrap text-center">
                <p class="section-kicker">
                    Website policy
                </p>

                <h1 class="section-title-premium">
                    Terms and Conditions
                </h1>

                <p class="mx-auto section-lead">
                    These terms explain how customers may use the Mega Carpets website, request quotes and engage with our
                    flooring products and services.
                </p>

                <p class="mt-5 text-sm font-bold text-mega-muted">
                    Last updated: {{ date('d F Y') }}
                </p>
            </div>
        </div>
    </section>

    <section class="bg-white py-12 md:py-16">
        <div class="site-container">
            <div class="legal-wrap">
                <div class="legal-card">
                    <div class="legal-content">
                        <div class="legal-note">
                            <p>
                                <strong>Important:</strong> These terms apply to your use of the Mega Carpets website and
                                our quote request process. They do not limit any rights you may have under Australian
                                Consumer Law or any other law that cannot be excluded.
                            </p>
                        </div>

                        <h2>1. About these terms</h2>
                        <p>
                            This website is operated by Mega Carpets. By using this website, browsing our products,
                            submitting a quote request or contacting us through the website, you agree to these Terms and
                            Conditions.
                        </p>
                        <p>
                            If you do not agree with these terms, you should stop using the website.
                        </p>

                        <h2>2. Website information</h2>
                        <p>
                            We aim to keep the information on this website accurate, helpful and up to date. However,
                            product details, images, colours, descriptions, prices, availability and promotions may change
                            without notice.
                        </p>
                        <p>
                            Product images and colours are shown for general guidance only. Actual colours, texture and
                            finish may vary depending on screen settings, lighting, manufacturing batches and product
                            samples.
                        </p>

                        <h2>3. Product advice</h2>
                        <p>
                            Information on this website is general in nature and is provided to help customers understand
                            flooring options. It should not be treated as final product advice for your specific home or
                            project.
                        </p>
                        <p>
                            We recommend speaking with our team, viewing samples and arranging a measure and quote before
                            making a final flooring decision.
                        </p>

                        <h2>4. Quotes and estimates</h2>
                        <p>
                            Any prices, rough estimates or online calculations shown on the website are indicative only.
                            Final pricing depends on the selected product, confirmed measurements, room layout, installation
                            requirements, floor preparation, underlay, trims, uplift and removal, stock availability and
                            other project details.
                        </p>
                        <p>
                            A final quotation will be provided after relevant measurements, product choices and installation
                            requirements are confirmed.
                        </p>

                        <h2>5. Free measure and quote</h2>
                        <p>
                            Where we offer a free measure and quote, availability may depend on your location, appointment
                            times and service area. We may contact you to confirm your details before arranging an
                            appointment.
                        </p>
                        <p>
                            You are responsible for providing accurate contact details, access information and project
                            details when submitting a request.
                        </p>

                        <h2>6. Orders and product availability</h2>
                        <p>
                            Product availability is subject to supplier stock, manufacturing lead times and order
                            confirmation. We will let you know if a selected product is unavailable or delayed.
                        </p>
                        <p>
                            An order is not confirmed until product selections, measurements, pricing, payment terms and
                            installation details are accepted by Mega Carpets.
                        </p>

                        <h2>7. Payment</h2>
                        <p>
                            Payment terms will be confirmed at the time of quotation or order. Depending on the project, a
                            deposit or full payment may be required before products are ordered or installation is booked.
                        </p>
                        <p>
                            Late, failed or incomplete payments may delay product ordering, delivery or installation.
                        </p>

                        <h2>8. Installation</h2>
                        <p>
                            Installation dates are arranged based on product availability, installer availability and site
                            readiness. While we make reasonable efforts to meet agreed timeframes, delays may occur due to
                            factors outside our control.
                        </p>
                        <p>
                            You must ensure the installation area is ready, safe and accessible. This may include removing
                            small furniture, valuables, breakables, appliances or other items before installation day.
                        </p>

                        <h2>9. Site preparation</h2>
                        <p>
                            Some flooring projects may require additional preparation, including uplift and removal of
                            existing flooring, subfloor preparation, door adjustments, trims or other work. These
                            requirements will be discussed during the quote process where possible.
                        </p>
                        <p>
                            If hidden or unexpected site conditions are discovered, additional work or cost may be required
                            before installation can continue.
                        </p>

                        <h2>10. Cancellations and changes</h2>
                        <p>
                            If you need to change or cancel an appointment, please contact us as soon as possible. Changes
                            to confirmed orders may not always be possible once products have been ordered, cut, prepared or
                            allocated.
                        </p>
                        <p>
                            Custom orders, special orders, made-to-measure products or ordered stock may be subject to
                            supplier conditions.
                        </p>

                        <h2>11. Returns, refunds and consumer guarantees</h2>
                        <p>
                            Your rights under Australian Consumer Law are not excluded, restricted or modified by these
                            terms. If a product or service fails to meet a consumer guarantee, you may be entitled to a
                            remedy depending on the circumstances.
                        </p>
                        <p>
                            We may need to inspect the product, installation or issue before deciding the appropriate next
                            step. Where a problem is caused by misuse, lack of care, normal wear and tear, site conditions
                            or circumstances outside our control, a remedy may not be available.
                        </p>

                        <h2>12. Warranties</h2>
                        <p>
                            Product warranties are provided by the relevant manufacturer and vary depending on the product,
                            range and conditions of use. Installation workmanship warranties may also apply where
                            installation is arranged through Mega Carpets.
                        </p>
                        <p>
                            Warranty information for your selected product will be provided upon request or at the time of
                            purchase where applicable.
                        </p>

                        <h2>13. Care and maintenance</h2>
                        <p>
                            You are responsible for caring for your flooring in accordance with product-specific care
                            instructions and manufacturer recommendations. Incorrect cleaning, excessive moisture, harsh
                            chemicals or unsuitable use may affect product performance and warranty coverage.
                        </p>

                        <h2>14. Website use</h2>
                        <p>
                            You agree not to misuse this website. This includes attempting to interfere with website
                            security, submitting false information, copying website content without permission or using the
                            website for unlawful purposes.
                        </p>

                        <h2>15. Intellectual property</h2>
                        <p>
                            All content on this website, including text, images, layout, branding, graphics and design
                            elements, is owned by or licensed to Mega Carpets unless stated otherwise.
                        </p>
                        <p>
                            You may view the website for personal and non-commercial purposes only. You must not copy,
                            reproduce or reuse website content without written permission.
                        </p>

                        <h2>16. Third-party links</h2>
                        <p>
                            This website may contain links to third-party websites. We are not responsible for the content,
                            accuracy, policies or practices of third-party websites.
                        </p>

                        <h2>17. Limitation of liability</h2>
                        <p>
                            To the maximum extent permitted by law, Mega Carpets is not liable for indirect, incidental or
                            consequential loss arising from your use of the website or reliance on general website
                            information.
                        </p>
                        <p>
                            Nothing in these terms limits any rights, remedies or guarantees that cannot be excluded under
                            applicable law.
                        </p>

                        <h2>18. Privacy</h2>
                        <p>
                            We handle personal information in accordance with our Privacy Policy. By submitting information
                            through the website, you agree that we may use your information to respond to your enquiry,
                            provide a quote, arrange services and communicate with you.
                        </p>

                        <h2>19. Changes to these terms</h2>
                        <p>
                            We may update these Terms and Conditions from time to time. The updated version will be
                            published on this page with a new updated date.
                        </p>

                        <h2>20. Contact us</h2>
                        <p>
                            If you have any questions about these Terms and Conditions, please contact Mega Carpets.
                        </p>

                        <ul>
                            <li>Email: <a href="mailto:sales@megacarpet.com.au"
                                    class="font-black text-mega-orange">sales@megacarpet.com.au</a></li>
                            <li>Phone: <a href="tel:1300131196" class="font-black text-mega-orange">1300 131 196</a></li>
                            <li>Contact page: <a href="{{ route('frontend.contact') }}"
                                    class="font-black text-mega-orange">Contact Mega Carpets</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection