import PropTypes from "prop-types";

function Login({ handleUser }) {
  return (
    <>
      <h1>Login</h1>
      <button
        className="btn btn-warning"
        onClick={() => {
          handleUser("New user state context");
        }}
      >
        Change
      </button>
    </>
  );
}

export default Login;

Login.propTypes = {
  handleUser: PropTypes.func,
};
