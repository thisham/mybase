import React from "react";
import MainLayout from "../../components/MainLayout";

function Home(): JSX.Element {
  return (
    <MainLayout pageKey="HOME" pageTitle="Home">
      <div className="text-sm">Blm Support</div>
    </MainLayout>
  );
}

export default Home;
