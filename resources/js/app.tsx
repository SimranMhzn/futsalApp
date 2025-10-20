import ReactDOM from 'react-dom/client';
import { BrowserRouter, Link, Route, Routes } from 'react-router-dom';
import '../css/app.css';
import Blog from './pages/Blog';
import FindFutsal from './pages/FindFutsal';
import Home from './pages/Home';

function App() {
    return (
        <>
            <BrowserRouter>
                <nav className="relative z-50 flex items-center justify-between bg-emerald-600 px-4 py-3 text-white shadow">
                    <div className="flex items-center space-x-2">
                        <img src="/futsalLogo.png" alt="Futsal Logo" className="h-8 w-42 rounded-full" />
                    </div>
                    <ul className="flex items-center space-x-6">
                        <Link className="hover:text-yellow-300" to="/">
                            Home
                        </Link>
                        <Link className="hover:text-yellow-300" to="/futsals">
                            Find Futsal
                        </Link>
                        <Link className="hover:text-yellow-300" to="/blog">
                            Blog
                        </Link>
                        <li>
                            <span className="mx-2 h-6 border-l border-yellow-300"></span>
                        </li>
                        <li>
                            <a href="/login" className="hover:text-yellow-300">
                                Login
                            </a>
                        </li>

                        <a href="/register">
                            <button className="rounded bg-yellow-300 px-4 py-1 font-semibold text-green-900 transition hover:bg-yellow-400">
                                Register
                            </button>
                        </a>
                    </ul>
                </nav>

                <Routes>
                    <Route path="/" element={<Home />} />
                    <Route path="/futsals" element={<FindFutsal />} />
                    <Route path="/blog" element={<Blog />} />
                </Routes>
            </BrowserRouter>
        </>
    );
}

ReactDOM.createRoot(document.getElementById('root')!).render(<App />);
