import React from 'react';
import { Navigate } from 'react-router-dom';

type ProtectedRouteProps = {
    isAuthenticated: boolean;
    children: React.ReactElement;
};

const ProtectedRoute: React.FC<ProtectedRouteProps> = ({ isAuthenticated, children }) => {
    if (!isAuthenticated) {
        return <Navigate to="/" replace />;
    }
    return children;
};

export default ProtectedRoute;
