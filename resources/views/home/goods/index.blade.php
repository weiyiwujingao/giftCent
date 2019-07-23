@extends('home.layouts.layout')
@section('css')
<link type="text/css" rel="stylesheet" href="/min/b=home/css&amp;f=header.css,goods_index.css" />
@endsection
@section('content')
    @include('home.common.header',['title'=>'商品管理'])
    <div class="top_search_bx">
        <div class="weui-search-bar" id="searchBar">
            <form class="weui-search-bar__form">
                <div class="weui-flex">
                    <div class="weui-cell weui-cell_select weui-cell_select-before">
                        <div class="weui-cell__hd">
                            <select class="weui-select" name="select2">
                                <option value="">全部分类</option>
                                <option value="2">蛋糕</option>
                                <option value="3">面包</option>
                                <option value="4">小吃</option>
                            </select>
                        </div>
                    </div>
                    <div class="weui-flex__item">
                        <div class="weui-search-bar__box">
                            <i class="weui-icon-search"></i>
                            <input type="search" class="weui-search-bar__input" id="searchInput" placeholder="商品搜索"
                                   required/>
                            <a href="javascript:" class="weui-icon-clear" id="searchClear"></a>
                        </div>
                        <label class="weui-search-bar__label" id="searchText">
                            <i class="weui-icon-search"></i>
                            <span>商品搜索</span>
                        </label>
                    </div>
                </div>
            </form>
            <a href="javascript:" class="weui-search-bar__cancel-btn" id="searchCancel">取消</a>
        </div>
        <div class="weui-cells searchbar-result" id="searchResult" style="display: none;">
            <div class="weui-cell weui-cell_access">
                <div class="weui-cell__bd weui-cell_primary">
                    <p>实时搜索文本</p>
                </div>
            </div>
        </div>
    </div>
    <div class="goods_list">
        <div class="weui-flex item">
            <div class="weui-flex__item left" onclick="location='{{ url('/home/goods/detail') }}';"><img src="/images/default-bg.jpg"/></div>
            <div class="weui-flex__item title">
                <p>超级好吃的榴莲千层</p>
                <p class="sales">销量：200</p>
                <p class="price">售价：￥20.00</p>
            </div>
            <div class="weui-flex__item right">
                <button class="weui-btn weui-btn_mini weui-btn_primary sxjia"><span>上架</span>
                    <i class="iconfont icon-icon_down-copy"></i>
                </button>
                <button class="weui-btn weui-btn_mini weui-btn_default" onclick="location='{{ url('/home/goods/detail') }}';">购买</button>
            </div>
        </div>
        <div class="weui-flex item">
            <div class="weui-flex__item left"><img src="/images/default-bg.jpg"/></div>
            <div class="weui-flex__item title">
                <p>超级好吃的榴莲千层</p>
                <p class="sales">销量：200</p>
                <p class="price">售价：￥20.00</p>
            </div>
            <div class="weui-flex__item right">
                <button class="weui-btn weui-btn_mini weui-btn_primary sxjia"><span>上架</span>
                    <i class="iconfont icon-icon_down-copy"></i>
                </button>
                <button class="weui-btn weui-btn_mini weui-btn_default">购买</button>
            </div>
        </div>
        <div class="weui-flex item">
            <div class="weui-flex__item left"><img src="/images/default-bg.jpg"/></div>
            <div class="weui-flex__item title">
                <p>超级好吃的榴莲千层</p>

                <p class="sales">销量：200</p>

                <p class="price">售价：￥20.00</p>
            </div>
            <div class="weui-flex__item right">
                <button class="weui-btn weui-btn_mini weui-btn_primary sxjia"><span>上架</span>
                    <i class="iconfont icon-icon_down-copy"></i>
                </button>
                <button class="weui-btn weui-btn_mini weui-btn_default">购买</button>
            </div>
        </div>
        <div class="weui-flex item">
            <div class="weui-flex__item left"><img src="/images/default-bg.jpg"/></div>
            <div class="weui-flex__item title">
                <p>超级好吃的榴莲千层</p>

                <p class="sales">销量：200</p>

                <p class="price">售价：￥20.00</p>
            </div>
            <div class="weui-flex__item right">
                <button class="weui-btn weui-btn_mini weui-btn_primary sxjia"><span>上架</span>
                    <i class="iconfont icon-icon_down-copy"></i>
                </button>
                <button class="weui-btn weui-btn_mini weui-btn_default">购买</button>
            </div>
        </div>
        <div class="weui-flex item">
            <div class="weui-flex__item left"><img src="/images/default-bg.jpg"/></div>
            <div class="weui-flex__item title">
                <p>超级好吃的榴莲千层</p>

                <p class="sales">销量：200</p>

                <p class="price">售价：￥20.00</p>
            </div>
            <div class="weui-flex__item right">
                <button class="weui-btn weui-btn_mini weui-btn_primary sxjia"><span>上架</span>
                    <i class="iconfont icon-icon_down-copy"></i>
                </button>
                <button class="weui-btn weui-btn_mini weui-btn_default">购买</button>
            </div>
        </div>
        <div class="weui-flex item">
            <div class="weui-flex__item left"><img src="/images/default-bg.jpg"/></div>
            <div class="weui-flex__item title">
                <p>超级好吃的榴莲千层</p>

                <p class="sales">销量：200</p>

                <p class="price">售价：￥20.00</p>
            </div>
            <div class="weui-flex__item right">
                <button class="weui-btn weui-btn_mini weui-btn_primary sxjia"><span>上架</span>
                    <i class="iconfont icon-icon_down-copy"></i>
                </button>
                <button class="weui-btn weui-btn_mini weui-btn_default">购买</button>
            </div>
        </div>
        <div class="weui-flex item">
            <div class="weui-flex__item left"><img src="/images/default-bg.jpg"/></div>
            <div class="weui-flex__item title">
                <p>超级好吃的榴莲千层</p>

                <p class="sales">销量：200</p>

                <p class="price">售价：￥20.00</p>
            </div>
            <div class="weui-flex__item right">
                <button class="weui-btn weui-btn_mini weui-btn_primary sxjia"><span>上架</span>
                    <i class="iconfont icon-icon_down-copy"></i>
                </button>
                <button class="weui-btn weui-btn_mini weui-btn_default">购买</button>
            </div>
        </div>
        <div class="weui-flex item">
            <div class="weui-flex__item left"><img src="/images/default-bg.jpg"/></div>
            <div class="weui-flex__item title">
                <p>超级好吃的榴莲千层</p>

                <p class="sales">销量：200</p>

                <p class="price">售价：￥20.00</p>
            </div>
            <div class="weui-flex__item right">
                <button class="weui-btn weui-btn_mini weui-btn_primary sxjia"><span>上架</span>
                    <i class="iconfont icon-icon_down-copy"></i>
                </button>
                <button class="weui-btn weui-btn_mini weui-btn_default">购买</button>
            </div>
        </div>
        <div class="weui-loadmore">
            <i class="weui-loading"></i>
            <span class="weui-loadmore__tips">正在加载</span>
        </div>
        <div class="weui-loadmore weui-loadmore_line">
            <span class="weui-loadmore__tips nobg">到底啦~</span>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        $(function () {
            //搜索
            var $searchBar = $('#searchBar'),
                    $searchResult = $('#searchResult'),
                    $searchText = $('#searchText'),
                    $searchInput = $('#searchInput'),
                    $searchClear = $('#searchClear'),
                    $searchCancel = $('#searchCancel');

            function hideSearchResult() {
                $searchResult.hide();
                $searchInput.val('');
            }

            function cancelSearch() {
                hideSearchResult();
                $searchBar.removeClass('weui-search-bar_focusing');
                $searchText.show();
            }

            $searchText.on('click', function () {
                $searchBar.addClass('weui-search-bar_focusing');
                $searchInput.focus();
            });
            $searchInput
                    .on('blur', function () {
                        if (!this.value.length) cancelSearch();
                    })
                    .on('input', function () {
                        if (this.value.length) {
                            $searchResult.show();
                        } else {
                            $searchResult.hide();
                        }
                    })
            ;
            $searchClear.on('click', function () {
                hideSearchResult();
                $searchInput.focus();
            });
            $searchCancel.on('click', function () {
                cancelSearch();
                $searchInput.blur();
            });
            //上下架
            $('.sxjia').click(function () {
                var $this = $(this);
                weui.picker([
                    {
                        label: '上架',
                        value: 1
                    },
                    {
                        label: '下架',
                        value: 0
                    }
                ], {
                    className: 'custom-classname',
                    container: 'body',
                    defaultValue: [1],
                    onChange: function (result) {
                        //console.log(result)
                    },
                    onConfirm: function (result) {
                        //console.log(result)
                        var val = result[0], txt = val == 1 ? '上架' : '下架';
                        $this.find('span').text(txt);
                        if (val == 1) {
                            $this.removeClass('bg_gray');
                            $this.addClass('weui-btn_primary');
                        } else {
                            $this.removeClass('weui-btn_primary');
                            $this.addClass('bg_gray');
                        }
                    }
                });
            });
        });
    </script>
@endsection