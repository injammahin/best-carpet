@extends('layouts.frontend')

@section('title', 'Privacy Policy | Mega Carpets')
@section('meta_description', 'Read the Mega Carpets Privacy Policy and learn how we collect, use, store and protect personal information.')

@section('content')

    <style>
        .privacy-hero {
            background: #f8f3ed;
            border-bottom: 1px solid #eadfd6;
        }

        .privacy-wrap {
            max-width: 980px;
            margin: 0 auto;
        }

        .privacy-card {
            border: 1px solid #eadfd6;
            background: #ffffff;
            border-radius: 7px;
            padding: 34px;
            box-shadow: 0 24px 70px rgba(7, 7, 7, 0.05);
        }

        .privacy-content {
            color: #5f5964;
            font-size: 16px;
            font-weight: 600;
            line-height: 1.85;
        }

        .privacy-content h2 {
            margin-top: 36px;
            margin-bottom: 12px;
            color: #070707;
            font-size: 28px;
            font-weight: 950;
            line-height: 1.15;
            letter-spacing: -0.045em;
        }

        .privacy-content h2:first-child {
            margin-top: 0;
        }

        .privacy-content p {
            margin-top: 12px;
        }

        .privacy-content ul {
            margin-top: 14px;
            display: grid;
            gap: 10px;
            padding-left: 0;
            list-style: none;
        }

        .privacy-content li {
            position: relative;
            padding-left: 30px;
        }

        .privacy-content li::before {
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

        .privacy-note {
            border: 1px solid rgba(255, 90, 0, 0.24);
            background: #fff7f1;
            border-radius: 7px;
            padding: 22px;
        }

        .privacy-note strong {
            color: #070707;
        }

        @media (max-width: 640px) {
            .privacy-card {
                padding: 24px;
            }

            .privacy-content h2 {
                font-size: 24px;
            }
        }
    </style>

    <section class="privacy-hero py-14 md:py-20">
        <div class="site-container">
            <div class="privacy-wrap text-center">
                <p class="section-kicker">
                    Website policy
                </p>

                <h1 class="section-title-premium">
                    Privacy Policy
                </h1>

                <p class="mx-auto section-lead">
                    This Privacy Policy explains how Mega Carpets collects, uses, stores and protects personal information.
                </p>

                <p class="mt-5 text-sm font-bold text-mega-muted">
                    Last updated: {{ date('d F Y') }}
                </p>
            </div>
        </div>
    </section>

    <section class="bg-white py-12 md:py-16">
        <div class="site-container">
            <div class="privacy-wrap">
                <div class="privacy-card">
                    <div class="privacy-content">
                        <div class="privacy-note">
                            <p>
                                <strong>Your privacy matters.</strong> Mega Carpets collects personal information only where
                                it is reasonably needed to respond to enquiries, provide quotes, arrange services, manage
                                customer relationships and operate our business.
                            </p>
                        </div>

                        <h2>1. About this Privacy Policy</h2>
                        <p>
                            This Privacy Policy applies to Mega Carpets and explains how we handle personal information
                            collected through our website, quote forms, contact forms, phone calls, emails, showroom
                            enquiries and customer interactions.
                        </p>
                        <p>
                            By using our website or providing personal information to us, you agree to the handling of your
                            information as described in this Privacy Policy.
                        </p>

                        <h2>2. What personal information we collect</h2>
                        <p>
                            The personal information we collect depends on how you interact with us. This may include:
                        </p>

                        <ul>
                            <li>Your name</li>
                            <li>Email address</li>
                            <li>Phone number</li>
                            <li>Installation address, suburb and postcode</li>
                            <li>Company name, where relevant</li>
                            <li>Preferred contact method</li>
                            <li>Products, rooms, flooring preferences and project details</li>
                            <li>Messages, comments and quote request information</li>
                            <li>Appointment details</li>
                            <li>Website usage information, such as pages visited, browser type and device information</li>
                            <li>Any other information you choose to provide to us</li>
                        </ul>

                        <h2>3. How we collect personal information</h2>
                        <p>
                            We may collect personal information when you:
                        </p>

                        <ul>
                            <li>Submit a free measure and quote form</li>
                            <li>Contact us through the website</li>
                            <li>Call, email or message us</li>
                            <li>Visit our showroom or request a mobile showroom appointment</li>
                            <li>Ask for product advice or warranty support</li>
                            <li>Interact with our website, advertisements or social media pages</li>
                            <li>Subscribe to updates or marketing communications</li>
                        </ul>

                        <h2>4. Why we collect personal information</h2>
                        <p>
                            We collect and use personal information for business purposes, including to:
                        </p>

                        <ul>
                            <li>Respond to enquiries</li>
                            <li>Prepare and provide quotes</li>
                            <li>Arrange measure and quote appointments</li>
                            <li>Provide product advice and customer support</li>
                            <li>Process product orders and installation requests</li>
                            <li>Contact you about your project or appointment</li>
                            <li>Send service updates or requested information</li>
                            <li>Improve our website, services and customer experience</li>
                            <li>Manage reviews, feedback, complaints or warranty enquiries</li>
                            <li>Meet legal, accounting, insurance and record-keeping obligations</li>
                        </ul>

                        <h2>5. Marketing communications</h2>
                        <p>
                            We may send you marketing communications about products, promotions, offers or services where
                            you have agreed to receive them or where permitted by law.
                        </p>
                        <p>
                            You can opt out of marketing communications at any time by following the unsubscribe
                            instructions in our emails or by contacting us directly.
                        </p>

                        <h2>6. Cookies and website analytics</h2>
                        <p>
                            Our website may use cookies, analytics tools and similar technologies to understand how visitors
                            use the website, improve performance and support marketing activity.
                        </p>
                        <p>
                            Cookies may collect information such as browser type, device type, pages visited, time spent on
                            the website and referring websites. You can adjust your browser settings to block or delete
                            cookies, but some website features may not work properly.
                        </p>

                        <h2>7. Who we share personal information with</h2>
                        <p>
                            We may share personal information with trusted third parties where reasonably required for our
                            business operations, including:
                        </p>

                        <ul>
                            <li>Installers and contractors who assist with flooring projects</li>
                            <li>Suppliers and manufacturers where needed for product orders or warranty matters</li>
                            <li>IT, website hosting, email, CRM and software providers</li>
                            <li>Payment, accounting, bookkeeping and administration providers</li>
                            <li>Marketing, analytics and advertising service providers</li>
                            <li>Professional advisers, insurers or legal representatives</li>
                            <li>Government, regulatory or law enforcement bodies where required by law</li>
                        </ul>

                        <p>
                            We do not sell personal information.
                        </p>

                        <h2>8. Overseas service providers</h2>
                        <p>
                            Some of our website, hosting, email, analytics or software providers may store or process
                            information outside Australia. Where this occurs, we take reasonable steps to work with
                            reputable providers and protect the information we hold.
                        </p>

                        <h2>9. How we protect personal information</h2>
                        <p>
                            We take reasonable steps to protect personal information from misuse, interference, loss,
                            unauthorised access, modification or disclosure.
                        </p>
                        <p>
                            These steps may include secure systems, access controls, password protection, staff awareness,
                            secure website technology and limiting access to personal information where practical.
                        </p>

                        <h2>10. How long we keep personal information</h2>
                        <p>
                            We keep personal information for as long as reasonably needed for the purpose it was collected,
                            including to provide services, manage customer records, handle enquiries, meet legal obligations
                            and resolve disputes.
                        </p>
                        <p>
                            When information is no longer required, we may take reasonable steps to delete, destroy or
                            de-identify it.
                        </p>

                        <h2>11. Accessing or correcting your information</h2>
                        <p>
                            You may contact us to request access to personal information we hold about you or to ask us to
                            correct information that is inaccurate, incomplete or out of date.
                        </p>
                        <p>
                            We may need to verify your identity before responding to a request. In some circumstances, we
                            may be unable to provide access, for example where legal restrictions apply.
                        </p>

                        <h2>12. Privacy complaints</h2>
                        <p>
                            If you have a concern about how we handle your personal information, please contact us first so
                            we can review the issue and respond.
                        </p>
                        <p>
                            We will aim to respond to privacy enquiries and complaints within a reasonable time.
                        </p>

                        <h2>13. Third-party websites</h2>
                        <p>
                            Our website may contain links to third-party websites. We are not responsible for the privacy
                            practices, content or security of those websites.
                        </p>

                        <h2>14. Children’s privacy</h2>
                        <p>
                            Our website and services are intended for adults, homeowners, tenants, property managers and
                            business customers. We do not knowingly collect personal information from children.
                        </p>

                        <h2>15. Changes to this Privacy Policy</h2>
                        <p>
                            We may update this Privacy Policy from time to time. The updated version will be published on
                            this page with a new updated date.
                        </p>

                        <h2>16. Contact us</h2>
                        <p>
                            If you have any questions about this Privacy Policy, or if you want to request access to or
                            correction of your personal information, please contact Mega Carpets.
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