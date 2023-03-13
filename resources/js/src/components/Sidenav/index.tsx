import React from "react";
import { Link } from "react-router-dom";
import { PageKey } from "@src/types/common";
import style from "./Style.module.css";
import {
  GitBranch,
  Home,
  Icon,
  Logout,
  PencilMinus,
  PictureInPicture,
  ReportMoney,
  Target,
} from "tabler-icons-react";

type SidenavProps = {
  activePage: PageKey;
};

type LinkItemProps = {
  code: PageKey;
  title: string;
  icon: Icon;
  destination: string;
};

function Sidenav(props: SidenavProps): JSX.Element {
  const LinkItem = (localProps: LinkItemProps) => {
    if (props.activePage === localProps.code)
      return (
        <div className={style.menu_item_active}>
          <localProps.icon width={16} height={16} /> {localProps.title}
        </div>
      );

    return (
      <Link to={localProps.destination} className={style.menu_item_inactive}>
        <localProps.icon width={16} height={16} />
        {localProps.title}
      </Link>
    );
  };

  return (
    <nav className={style.base}>
      <div className={style.profile_container}>
        <Link to={"/profile"} className={style.profile_picture_container}>
          <img
            // src="https://i.pinimg.com/564x/51/04/46/5104462af6d4e0781beddbeec4b3ad58.jpg"
            src="https://i.pinimg.com/564x/81/cb/8a/81cb8aca3f5691f19929a4328831aeb3.jpg"
            alt="Profile Picture"
            className={style.profile_picture}
          />
        </Link>
        <div className={style.profile_user_data}>
          <div className={style.profile_fullname}>User Shimei</div>
          <div className={style.profile_email}>user.shimei@example.com</div>
        </div>
      </div>

      <div className={style.menu_container}>
        <LinkItem code={"HOME"} title={"Home"} destination={"/"} icon={Home} />
        <LinkItem
          code={"PROJECT"}
          title={"Projects"}
          destination={"/projects"}
          icon={GitBranch}
        />
        {/* <LinkItem code={"DIARY"} title={"Diaries"} destination={"/diaries"} /> */}
        <LinkItem
          code={"GALLERY"}
          title={"Gallery"}
          destination={"/galleries"}
          icon={PictureInPicture}
        />
        <LinkItem
          code={"TIL"}
          title={"TILs"}
          destination={"/tils"}
          icon={PencilMinus}
        />
        <LinkItem
          code={"TARGET"}
          title={"Targets & Dreams"}
          destination={"/targets"}
          icon={Target}
        />
        <LinkItem
          code={"FINANCE"}
          title={"Finances"}
          destination={"/finances"}
          icon={ReportMoney}
        />
        <LinkItem
          code={"SIGN_OUT"}
          title={"Sign Out"}
          destination={"/sign-out"}
          icon={Logout}
        />
      </div>
    </nav>
  );
}

export default Sidenav;
