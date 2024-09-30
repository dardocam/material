import { useContext } from "react";
import { Context } from "../App";

export const Btn = () => {
  const [login, setLogin] = useContext(Context);
  return (
    <button onClick={() => setLogin(!login)}>
      {login ? "LogOut" : "LogIn"}
    </button>
  );
};
