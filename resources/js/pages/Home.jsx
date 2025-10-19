import { Button, Card } from 'flowbite-react';
import FeaturedFutsals from "../components/FeaturedFutsals";
import { FaFacebook, FaInstagram, FaTwitter } from 'react-icons/fa';
import { MdLocationOn, MdOutlineAccessTimeFilled, MdVerified } from 'react-icons/md';
import { useNavigate } from 'react-router-dom';
export default function Home() {
    const navigate = useNavigate();
    const handleFindFutsals = () => {
        navigate('/futsals');
    }
    return (
        <>
            <div>
                <section className="flex flex-col bg-emerald-800 px-14 py-24 text-white">
                    <div>
                        <h1 className="mb-2 text-3xl font-bold md:text-5xl">Book Your Perfect Futsal Court in Seconds</h1>
                        <p className="md:text-s mb-8 text-lg">
                            Find available courts near you and reserve your spot in seconds. No hassle, no waiting.
                        </p>
                    </div>
                    <Button onClick={handleFindFutsals} className="w-40 rounded-xl border-2 border-white p-2.5 transition-transform hover:scale-105">Find Futsals Now</Button>
                </section>

                <section className="mx-auto max-w-6xl px-4 py-20">
                    <h2 className="mb-12 text-center text-4xl font-semibold text-gray-900 dark:text-white">Why Choose FutsalHub?</h2>
                    <div className="grid grid-cols-1 gap-8 md:grid-cols-3">
                        <Card className="border-green-400 p-6 text-center align-middle transition-shadow hover:shadow-lg">
                            <div className="mb-3 flex justify-center">
                                <button className="items-center rounded-full bg-emerald-200 p-3">
                                    <MdOutlineAccessTimeFilled size={30} color="green" />
                                </button>
                            </div>
                            <h3 className="mb-2 text-xl font-bold text-green-600">Quick Booking</h3>
                            <p>Book your favourite futsal court in less than a minute. No phone calls needed.</p>
                        </Card>

                        <Card className="border-green-400 p-6 text-center align-middle transition-shadow hover:shadow-lg">
                            <div className="mb-3 flex justify-center">
                                <button className="items-center rounded-full bg-emerald-200 p-3">
                                    <MdLocationOn size={30} color="green" />
                                </button>
                            </div>
                            <h3 className="mb-2 text-xl font-bold text-green-600">Find Nearby Courts</h3>
                            <p>Discover the best futsal courts near your location with real-time availability.</p>
                        </Card>

                        <Card className="border-green-400 p-6 text-center align-middle transition-shadow hover:shadow-lg">
                            <div className="mb-3 flex justify-center">
                                <button className="items-center rounded-full bg-emerald-200 p-3">
                                    <MdVerified size={30} color="green" />
                                </button>
                            </div>
                            <h3 className="mb-2 text-xl font-bold text-green-600">Verified Venues</h3>
                            <p>All futsal courts are verified for quality and facilities. Play with confidence.</p>
                        </Card>
                    </div>
                </section>

                <FeaturedFutsals onFindFutsals={handleFindFutsals} />

                <section className="bg-gray-50 px-6 py-20 dark:bg-gray-800">
                    <h2 className="mb-16 text-center text-4xl font-semibold text-gray-900 dark:text-white">How It Works</h2>
                    <div className="mx-auto grid max-w-6xl grid-cols-1 gap-10 md:grid-cols-3">
                        {[
                            {
                                number: '1',
                                title: 'Find a Futsal Court',
                                desc: 'Browse through our extensive list of futsal courts and filter by location, price, or facilities.',
                            },
                            {
                                number: '2',
                                title: 'Choose your time slot',
                                desc: 'Select from available time slots that fit your schedule and see real-time availability.',
                            },
                            {
                                number: '3',
                                title: 'Book & Play',
                                desc: 'Complete your booking with secure payment and receive instant confirmation. Just show up and play!',
                            },
                        ].map((item, idx) => (
                            <div
                                key={idx}
                                className="rounded-2xl bg-white p-8 text-center shadow-md transition-shadow hover:shadow-xl dark:bg-gray-700"
                            >
                                <div className="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-green-600 text-2xl font-bold text-white">
                                    {item.number}
                                </div>
                                <h3 className="mb-3 text-xl font-bold text-gray-900 dark:text-white">{item.title}</h3>
                                <p className="text-gray-600 dark:text-gray-300">{item.desc}</p>
                            </div>
                        ))}
                    </div>

                    <div className="mt-14 flex justify-center">
                        <Button onClick={handleFindFutsals} className="rounded-xl bg-green-600 px-6 py-3 font-semibold text-white shadow-md transition-transform hover:scale-105 hover:bg-green-700">
                            Find a Court Now
                        </Button>
                    </div>
                </section>
            </div>

            <div className="bg-green-700 text-white">
                <div className="py-12 text-center">
                    <h2 className="mb-2 text-2xl font-bold">Ready to Find Your Perfect Futsal Court?</h2>
                    <p className="mb-6">
                        Join thousands of futsal players who book courts through Booksall every day. <br />
                        Fast, easy, and reliable.
                    </p>
                    <div className="flex justify-center gap-4">
                        <Button onClick={handleFindFutsals} color="light" className="font-bold">
                            Browse Futsals
                        </Button>
                        <Button color="light" className="border-2 border-white font-bold">
                            Create Free Account
                        </Button>
                    </div>
                </div>
            </div>
            <footer className="bg-green-900 px-8 py-10">
                <div className="grid grid-cols-1 gap-8 text-gray-200 md:grid-cols-3">
                    <div>
                        <h3 className="text-lg font-bold text-white">FutsalHub</h3>
                        <p className="mt-2 text-sm">The easiest way to book futsal courts near you. Play more, worry less.</p>
                        <div className="mt-4 flex gap-4 text-xl">
                            <FaFacebook className="cursor-pointer hover:text-white" />
                            <FaInstagram className="cursor-pointer hover:text-white" />
                            <FaTwitter className="cursor-pointer hover:text-white" />
                        </div>
                    </div>

                    <div>
                        <h3 className="text-lg font-bold text-white">Quick Links</h3>
                        <ul className="mt-2 space-y-2 text-sm">
                            <li>
                                <a href="#" className="hover:underline">
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="#" className="hover:underline">
                                    Find Futsals
                                </a>
                            </li>
                            <li>
                                <a href="#" className="hover:underline">
                                    About Us
                                </a>
                            </li>
                            <li>
                                <a href="#" className="hover:underline">
                                    Contact
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h3 className="text-lg font-bold text-white">Contact Us</h3>
                        <ul className="mt-2 space-y-2 text-sm">
                            <li>Kathmandu, Nepal</li>
                            <li>info@futsalhub.app</li>
                            <li>+977 9800000000</li>
                        </ul>
                    </div>
                </div>

                <div className="mt-8 flex flex-col justify-between border-t border-gray-500 pt-4 text-sm text-gray-300 md:flex-row">
                    <p>© 2025 FutsalHub. All rights reserved.</p>
                    <div className="mt-2 flex gap-4 md:mt-0">
                        <a href="#" className="hover:underline">
                            Privacy Policy
                        </a>
                        <a href="#" className="hover:underline">
                            Terms of Service
                        </a>
                    </div>
                </div>
            </footer>
        </>
    );
}
