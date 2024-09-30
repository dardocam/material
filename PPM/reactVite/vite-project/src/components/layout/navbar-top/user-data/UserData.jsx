import PropTypes from "prop-types";
import { useContext } from "react";
import { UserContext } from "../../../../App";

function UserData({ menu }) {
  const user = useContext(UserContext);

  const listItems = menu.map((item) => (
    <li key={item.id} className="">
      <a className="dropdown-item" href={item.href}>
        {item.name}
      </a>
    </li>
  ));
  return (
    <div className="nav">
      <a
        className="nav-link dropdown-toggle"
        data-bs-toggle="dropdown"
        href="#"
        role="button"
        aria-expanded="false"
      >
        Dropdown {user}
      </a>
      <ul className="dropdown-menu">{listItems}</ul>
    </div>
  );
}

export default UserData;

UserData.propTypes = {
  menu: PropTypes.array,
};
