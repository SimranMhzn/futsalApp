import { useState, useEffect } from 'react';
import ReactDOM from 'react-dom/client';
import { BrowserRouter, Link, Route, Routes, useLocation } from 'react-router-dom';
import '../css/app.css';
import Blog from './pages/Blog';
import FindFutsal from './pages/FindFutsal';
import Home from './pages/Home';
import AddFutsalPage from './components/AddFutsalPage';

type User = {
    id: number;
    name: string;
    email: string;
    role?: string;
};

function AppWrapper() {
    return (
        <BrowserRouter>
            <App />
        </BrowserRouter>
    );
}

function App() {
    const [isAuthenticated, setIsAuthenticated] = useState<boolean>(false);
    const [user, setUser] = useState<User | null>(null);

    const location = useLocation();

    // Paths allowed without login
    const publicPaths = ['/', '/futsals', '/blog'];

    useEffect(() => {
        const userData = localStorage.getItem('user');
        const token = localStorage.getItem('token');
        if (userData && token) {
            setIsAuthenticated(true);
            setUser(JSON.parse(userData) as User);
        }
    }, []);

    const handleLogout = () => {
        localStorage.removeItem('user');
        localStorage.removeItem('token');
        setIsAuthenticated(false);
        setUser(null);
        fetch('/logout', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': (document.querySelector('meta[name="csrf-token"]') as HTMLMetaElement)?.content || '',
            },
        });
        window.location.href = '/';
    };

    // Redirect non-authenticated users on non-public paths
    if (!isAuthenticated && !publicPaths.includes(location.pathname)) {
        window.location.href = '/login'; // Laravel login page
        return null; // stop rendering React
    }

    return (
        <>
            {/* Navbar */}
            <nav className="relative z-50 flex items-center justify-between bg-emerald-600 px-4 py-3 text-white shadow">
                <div className="flex items-center space-x-2">
                    <img src="/futsalLogo.png" alt="Futsal Logo" className="h-8 w-42 rounded-full" />
                </div>
                <ul className="flex items-center space-x-6">
                    <Link className="hover:text-yellow-300" to="/">Home</Link>
                    <Link className="hover:text-yellow-300" to="/futsals">Find Futsal</Link>
                    <Link className="hover:text-yellow-300" to="/blog">Blog</Link>
                    <li><span className="mx-2 h-6 border-l border-yellow-300"></span></li>

                    {!isAuthenticated ? (
                        <>
                            <li><a href="/login" className="hover:text-yellow-300">Login</a></li>
                            <li>
                                <a href="/register">
                                    <button className="rounded bg-yellow-300 px-4 py-1 font-semibold text-green-900 transition hover:bg-yellow-400">
                                        Register
                                    </button>
                                </a>
                            </li>
                        </>
                    ) : (
                        <>
                            <li><Link className="hover:text-yellow-300" to="/profile">Profile</Link></li>
                            <li>
                                <button
                                    onClick={handleLogout}
                                    className="rounded bg-red-500 px-4 py-1 font-semibold text-white transition hover:bg-red-600"
                                >
                                    Logout
                                </button>
                            </li>
                        </>
                    )}
                </ul>
            </nav>

            {/* Routes */}
            <Routes>
                {/* Public routes */}
                <Route path="/" element={<Home />} />
                <Route path="/futsals" element={<FindFutsal />} />
                <Route path="/blog" element={<Blog />} />

                {/* Protected routes */}
                <Route path="/addFutsal" element={<AddFutsalPage />} />
                <Route path="/profile" element={<Home />} /> {/* Replace Home with Profile component if exists */}

                {/* Catch-all: redirect handled by window.location.href */}
                <Route path="*" element={null} />
            </Routes>
        </>
    );
}

ReactDOM.createRoot(document.getElementById('root')!).render(<AppWrapper />);
