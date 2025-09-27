export default function Navbar() {
  return (
    <nav className="bg-green-700 text-white px-4 py-3 shadow flex items-center justify-between">
      <div className="flex items-center space-x-2">
        <img src="/futsalLogo.png" alt="Futsal Logo" className="h-8 w-42 rounded-full" />
      </div>
      <ul className="flex space-x-6 items-center">
        <li><a href="/" className="hover:text-yellow-300">Home</a></li>
        <li><a href="/about" className="hover:text-yellow-300">Find Futsals</a></li>
        <li><a href="/services" className="hover:text-yellow-300">Blog</a></li>
        <li>
          <span className="mx-2 border-l border-yellow-300 h-6"></span>
        </li>
        <li><a href="/login" className="hover:text-yellow-300">Login</a></li>
        <li>
          <a href="/register" className="bg-yellow-300 text-green-900 px-4 py-1 rounded hover:bg-yellow-400 font-semibold transition">
            Register
          </a>
        </li>
      </ul>
    </nav>
  );
}