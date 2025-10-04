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

        {/* Register dropdown using CSS hover */}
        <li className="relative group">
          <button className="bg-yellow-300 text-green-900 px-4 py-1 rounded hover:bg-yellow-400 font-semibold transition">
            Register
          </button>
          <ul className="absolute right-0 mt-2 w-48 bg-white text-green-900 rounded shadow-lg opacity-0 invisible group-hover:visible group-hover:opacity-100 transition-all">
            <li>
              <a href="/register" className="block px-4 py-2 hover:bg-yellow-200">Register as User</a>
            </li>
            <li>
              <a href="/ownerRegister" className="block px-4 py-2 hover:bg-yellow-200">Register as Owner</a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  );
}
