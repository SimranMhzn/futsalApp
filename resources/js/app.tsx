import ReactDOM from 'react-dom/client';
import { BrowserRouter, Link, Route, Routes } from 'react-router-dom';
import '../css/app.css';
import FindFutsal from './pages/FindFutsal';
import Home from './pages/Home';
import About from './pages/About';

function App() {
    return (
        <>
            <BrowserRouter>
                <nav className="flex items-center justify-between bg-emerald-600 px-4 py-3 text-white shadow relative z-50">
                    <div className="flex items-center space-x-2">
                        <img src="/futsalLogo.png" alt="Futsal Logo" className="h-8 w-42 rounded-full" />
                    </div>
                    <ul className="flex items-center space-x-6">
                        <Link className="hover:text-yellow-300" to="/">
                            Home
                        </Link>
                        <Link className="hover:text-yellow-300" to="/findFutsal">
                            Find Futsal
                        </Link>
                        <Link className="hover:text-yellow-300" to="/about">
                            About
                        </Link>
                        <li>
                            <span className="mx-2 h-6 border-l border-yellow-300"></span>
                        </li>
                        <li>
                            <a href="/login" className="hover:text-yellow-300">
                                Login
                            </a>
                        </li>

                        <li className="group relative">
                            <button className="rounded bg-yellow-300 px-4 py-1 font-semibold text-green-900 transition hover:bg-yellow-400">
                                Register
                            </button>
                            <ul className="invisible absolute right-0 mt-2 w-48 rounded bg-white text-green-900 opacity-0 shadow-lg transition-all group-hover:visible group-hover:opacity-100">
                                <li>
                                    <a href="/register" className="block px-4 py-2 hover:bg-yellow-200">
                                        Register as User
                                    </a>
                                </li>
                                <li>
                                    <a href="/ownerRegister" className="block px-4 py-2 hover:bg-yellow-200">
                                        Register as Owner
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>

                <Routes>
                    <Route path="/" element={<Home />} />
                    <Route path="/findFutsal" element={<FindFutsal />} />
                    <Route path="/about" element={<About />} />
                </Routes>
            </BrowserRouter>                                                
        </>
    );
}

ReactDOM.createRoot(document.getElementById('root')!).render(<App />);
