<template lang="">
  <div class="sidebar">
    <div class="user">
      <div class="user-photo">
        <span>
          <fa class="icon" icon="user" />
        </span>
      </div>

      <div class="user-name">
        <p class="name">Nome Usuário</p>
        <p class="type-user">admin</p>
      </div>
    </div>

    <div class="menu">
      <ul>
        <li>
          <a href="#"><fa icon="home" /> Início</a>
        </li>
        <li>
          <a href="#"><fa icon="tag" /> Categorias</a>
        </li>
        <li>
          <a href="#"><fa icon="arrow-right-from-bracket" /> Sair</a>
        </li>
      </ul>
    </div>
  </div>
</template>
<script>
export default {
  name: "SidebarContent",
};
</script>
<style>
.user {
  width: 100%;
  display: flex;
  align-items: center;
  padding: 24px 5px 0 0;
  margin-top: 20px;
  flex-direction: column;
}

.user-photo {
  margin-right: 12px;
}

.user-photo span {
  display: block;
  width: 60px;
  height: 60px;
  border-radius: 50%;
  background-color: #fff;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 30px;
  color: #8a8a8a;
}

.user-name {
  display: flex;
  align-items: center;
  flex-direction: column;
}

.name {
  font-size: 14px;
  color: #fff;
  margin-bottom: 0;
  margin-top: 5px;
  font-weight: bold;
}

.type-user {
  font-size: 10px;
  color: #fff;
  margin-bottom: 0;
}

.menu {
  margin-top: 30px;
  padding: 10px 20px 10px 0;
}

.menu ul {
  padding: 0;
  margin: 0;
}

.menu ul li {
  margin: 5px 0;
  font-size: 16px;
  list-style: none;
  font-weight: 200;
  width: 200px;
  display: flex;
}

.menu ul li:hover {
  cursor: pointer;
  background-color: #212529;
}

.menu ul li a {
  color: #fff;
  text-decoration: none;
  padding: 16px 14px;
  width: 200px;
}

/* .menu ul li a:hover {
  background-color: blue;
} */
</style>
