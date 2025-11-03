import ReactDOM from 'react-dom/client';
import 'flowbite';

function ReactApp() {
    return (
        <div className="p-4">
            <h1 className="text-2xl font-bold text-green-700">React Component Mounted Here</h1>
        </div>
    );
}

if (document.getElementById('react-root')) {
    ReactDOM.createRoot(document.getElementById('react-root')!).render(<ReactApp />);
}
