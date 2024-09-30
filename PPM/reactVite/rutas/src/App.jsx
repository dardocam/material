import { Btn } from "./components/Btn";
import { AppRouter } from "./router/AppRouter";
import { createContext, useState } from "react";

export const Context = createContext();

function App() {
  const [login, setLogin] = useState(false);

  return (
    <Context.Provider value={[login, setLogin]}>
      <AppRouter />
      <h1>{login ? "LOGIN" : "LOGOUT"}</h1>
      <Btn />
    </Context.Provider>
  );
}

export default App;
