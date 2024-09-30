import PropTypes from "prop-types";
import { useState } from "react";
import NavBar from "./NavBar";
import { Navigate } from "react-router-dom";

import db from "../firebase/firebaseConfig"; // Asegúrate de que la ruta sea correcta
import { query, where, getDocs, collection } from "firebase/firestore";

function Login({ setAuth }) {
  const [email, setEmail] = useState("");
  const [passw, setPassw] = useState("");

  const handleSubmit = async (e) => {
    e.preventDefault();
    if (email === "" || passw === "") {
      alert("Por favor, llena todos los campos.");
      return;
    }
    try {
      const users = collection(db, "usuarios");
      const q = query(users, where("email", "==", email));

      const querySnapshot = await getDocs(q);

      querySnapshot.forEach((doc) => {
        // doc.data() is never undefined for query doc snapshots
        // console.log(doc.id, " => ", doc.data());
        if (doc.data().email == email && doc.data().passw == passw) {
          //navigate for private route
          setAuth(true);
          <Navigate to="/dashboard" />;
        }
      });
      setEmail("");
      setPassw("");
    } catch (error) {
      console.error(error);
      alert("Se produjo un error inesperado");
    }
  };

  return (
    <>
      <NavBar></NavBar>
      <div>
        <form onSubmit={handleSubmit}>
          <input
            type="email"
            placeholder="Email"
            name="email"
            value={email}
            onChange={(e) => setEmail(e.target.value)}
          ></input>
          <input
            type="password"
            placeholder="Password"
            name="passw"
            value={passw}
            onChange={(e) => setPassw(e.target.value)}
          ></input>
          <button type="submit">SigsssnIn</button>
        </form>
      </div>
    </>
  );
}

export default Login;

Login.propTypes = {
  setAuth: PropTypes.func,
  auth: PropTypes.bool,
};
