import { useState, useEffect } from "react";
import Menu from "./menu/Menu";
import UserData from "./user-data/UserData";
import Logo from "./logo/Logo";

function NavBarTop() {
  const [navigator, setNavigator] = useState([]);

  useEffect(() => {
    setNavigator([
      { id: 1, href: "/", name: "Home" },
      { id: 2, href: "login", name: "Login" },
      { id: 3, href: "http://yahoo.com", name: "Yahoo" },
    ]);
  }, []);

  return (
    <header>
      <nav className="nav justify-content-around align-items-center">
        <Logo />
        <Menu menu={navigator} />
        <UserData menu={navigator} />
      </nav>
    </header>
  );
}

export default NavBarTop;
