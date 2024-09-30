import { Navigate } from "react-router-dom";
import PropTypes from 'prop-types';


function PrivateRoute({ auth: { isAuthenticated }, children }) {
    return isAuthenticated ? children : <Navigate to="/login" />;
}

export default PrivateRoute;


PrivateRoute.propTypes = {
    children: PropTypes.node,
    auth: PropTypes.object
  };

